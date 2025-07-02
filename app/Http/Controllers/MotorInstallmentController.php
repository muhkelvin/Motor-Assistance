<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorInstallmentController extends Controller
{
    public function index(Motor $motor)
    {
        $installments = $motor->motorinstallments()
            ->orderBy('down_payment')
            ->orderBy('tenor_months')
            ->get();

        return response()->json($installments);
    }
}
