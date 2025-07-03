<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreditSimulationRequest;
use App\Models\CreditSimulation;
use App\Models\LeasingCompany;
use App\Models\Motor;
use App\Models\MotorInstallment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CreditSimulationController extends Controller
{
    public function index()
    {
        $motors = Motor::active()->orderBy('name')->get();
        $leasingCompanies = LeasingCompany::active()->get();

        return view('credit-simulation.index', compact('motors', 'leasingCompanies'));
    }

    public function calculate(Request $request)
    {
        try {
            $validated = $request->validate([
                'motor_id' => 'required|exists:motors,id',
                'leasing_company_id' => 'required|exists:leasing_companies,id',
                'installment_id' => 'required|exists:motor_installments,id',
                'insurance_fee' => 'nullable|numeric',
                'additional_costs' => 'nullable|numeric'
            ]);

            $motor = Motor::findOrFail($request->motor_id);
            $leasingCompany = LeasingCompany::findOrFail($request->leasing_company_id);
            $installment = MotorInstallment::findOrFail($request->installment_id);

            // Validasi bahwa installment sesuai dengan motor
            if ($installment->motor_id != $motor->id) {
                return response()->json([
                    'error' => 'Paket cicilan tidak sesuai dengan motor yang dipilih'
                ], 400);
            }

            // Hitung total bunga
            $loanAmount = $motor->price - $installment->down_payment;
            $totalInterest = $loanAmount * ($leasingCompany->interest_rate / 100) * ($installment->tenor_months / 12);

            $creditSimulation = CreditSimulation::create([
                'motor_id' => $motor->id,
                'leasing_company_id' => $leasingCompany->id,
                'installment_id' => $installment->id,
                'motor_price' => $motor->price,
                'down_payment' => $installment->down_payment,
                'tenor_months' => $installment->tenor_months,
                'interest_rate' => $leasingCompany->interest_rate,
                'monthly_payment' => $installment->installment_amount,
                'total_payment' => ($installment->installment_amount * $installment->tenor_months) +
                    $leasingCompany->admin_fee +
                    ($request->insurance_fee ?? 0) +
                    ($request->additional_costs ?? 500000),
                'total_interest' => $totalInterest, // Ditambahkan
                'insurance_fee' => $request->insurance_fee ?? 0,
                'admin_fee' => $leasingCompany->admin_fee,
                'additional_costs' => $request->additional_costs ?? 500000,
                'session_id' => session()->getId()
            ]);

            return response()->json([
                'success' => true,
                'simulation' => $creditSimulation->load(['motor', 'leasingCompany', 'installment']),
                'redirect' => route('credit-simulation.result', $creditSimulation->id)
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validasi gagal: ' . implode(', ', $e->errors())
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Data tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function result($id)
    {
        $simulation = CreditSimulation::with(['motor', 'leasingCompany'])
            ->findOrFail($id);

        // Hitung total bunga
        $totalInterest = ($simulation->motor_price - $simulation->down_payment) *
            ($simulation->interest_rate / 100) *
            ($simulation->tenor_months / 12);

        // Perhitungan untuk leasing lainnya
        $comparisons = LeasingCompany::active()
            ->where('id', '!=', $simulation->leasing_company_id)
            ->get()
            ->map(function ($leasing) use ($simulation, $totalInterest) {
                $leasingInterest = ($simulation->motor_price - $simulation->down_payment) *
                    ($leasing->interest_rate / 100) *
                    ($simulation->tenor_months / 12);

                $leasingTotal = $simulation->down_payment +
                    ($simulation->motor_price - $simulation->down_payment) +
                    $leasingInterest +
                    $leasing->admin_fee +
                    $simulation->insurance_fee +
                    $simulation->additional_costs;

                return [
                    'leasing' => $leasing,
                    'monthly' => $this->formatCurrency(
                        ($simulation->motor_price - $simulation->down_payment + $leasingInterest) /
                        $simulation->tenor_months
                    ),
                    'total' => $this->formatCurrency($leasingTotal),
                    'savings' => $this->formatCurrency($simulation->total_payment - $leasingTotal),
                    'rating' => $this->calculateLeasingRating([
                        'total_cost' => $leasingTotal,
                        'monthly_payment' => ($simulation->motor_price - $simulation->down_payment + $leasingInterest) / $simulation->tenor_months
                    ], $leasing)
                ];
            })
            ->sortBy('total')
            ->values();

        // Tambahkan properti tambahan ke simulation
        $simulation->total_interest = $totalInterest;

        return view('credit-simulation.result', compact('simulation', 'comparisons', 'totalInterest'));
    }

    private function calculateLeasingRating($simulation, $leasing)
    {
        $score = 0;

        // Interest rate score (lower is better) - 40% weight
        $interestScore = max(0, 100 - ($leasing->interest_rate * 8));
        $score += $interestScore * 0.4;

        // Admin fee score (lower is better) - 25% weight
        $adminFeeScore = max(0, 100 - ($leasing->admin_fee / 15000));
        $score += $adminFeeScore * 0.25;

        // Total cost efficiency score - 35% weight
        $costEfficiencyScore = max(0, 100 - (($simulation['total_cost'] - 25000000) / 200000));
        $score += $costEfficiencyScore * 0.35;

        return min(100, max(0, round($score, 1)));
    }

    public function compare(Request $request)
    {
        $request->validate([
            'motor_id' => 'required|exists:motors,id',
            'down_payment' => 'required|numeric|min:0',
            'tenor_months' => 'required|integer|min:1'
        ]);

        $motor = Motor::findOrFail($request->motor_id);
        $minDP = $motor->price * 0.1;

        if ($request->down_payment < $minDP) {
            return back()->withErrors([
                'down_payment' => 'Uang muka minimal 10%: ' . $this->formatCurrency($minDP)
            ]);
        }

        $comparisons = LeasingCompany::active()->get()->map(function ($leasing) use ($request, $motor) {
            $calculation = $this->calculateSimulation(
                $motor->price,
                $request->down_payment,
                $request->tenor_months,
                $leasing->interest_rate,
                $leasing->admin_fee,
                $request->insurance_fee ?? 0,
                $request->additional_costs ?? 500000
            );

            return [
                'leasing' => $leasing,
                'monthly' => $this->formatCurrency($calculation['monthly']),
                'total' => $this->formatCurrency($calculation['total']),
                'rating' => $this->calculateRating($calculation, $leasing),
                'is_best' => false
            ];
        })->sortBy('total')->values();

        // Tandai yang terbaik
        if ($comparisons->isNotEmpty()) {
            $comparisons[0]['is_best'] = true;
        }

        return view('credit-simulation.compare', [
            'motor' => $motor,
            'comparisons' => $comparisons,
            'downPayment' => $request->down_payment,
            'tenorMonths' => $request->tenor_months
        ]);
    }

    private function calculateSimulation($price, $dp, $tenor, $interest, $adminFee, $insurance, $additional)
    {
        $loan = $price - $dp;
        $totalInterest = $loan * ($interest / 100) * ($tenor / 12);
        $monthly = ($loan + $totalInterest) / $tenor;
        $total = $dp + ($monthly * $tenor) + $adminFee + $insurance + $additional;

        return [
            'monthly' => $monthly,
            'total' => $total,
            'interest' => $totalInterest
        ];
    }

    private function calculateRating($calculation, $leasing)
    {
        // Skor berdasarkan suku bunga dan biaya admin
        $interestScore = max(0, 100 - ($leasing->interest_rate * 10));
        $adminScore = max(0, 100 - ($leasing->admin_fee / 100000));

        return min(100, ($interestScore * 0.7) + ($adminScore * 0.3));
    }

    private function formatCurrency($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
