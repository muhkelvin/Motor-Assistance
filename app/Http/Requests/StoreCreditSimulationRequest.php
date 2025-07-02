<?php
// app/Http/Requests/StoreCreditSimulationRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreditSimulationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'motor_id' => 'required|exists:motors,id',
            'leasing_company_id' => 'required|exists:leasing_companies,id',
            'down_payment' => 'required|numeric|min:0',
            'tenor_months' => 'required|integer|in:12,24,36,48,60',
            'insurance_fee' => 'nullable|numeric|min:0',
            'additional_costs' => 'nullable|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'motor_id.required' => 'Motor harus dipilih.',
            'motor_id.exists' => 'Motor yang dipilih tidak valid.',
            'leasing_company_id.required' => 'Perusahaan leasing harus dipilih.',
            'leasing_company_id.exists' => 'Perusahaan leasing yang dipilih tidak valid.',
            'down_payment.required' => 'Down payment harus diisi.',
            'down_payment.numeric' => 'Down payment harus berupa angka.',
            'down_payment.min' => 'Down payment tidak boleh kurang dari 0.',
            'tenor_months.required' => 'Tenor harus dipilih.',
            'tenor_months.integer' => 'Tenor harus berupa angka.',
            'tenor_months.in' => 'Tenor harus salah satu dari: 12, 24, 36, 48, atau 60 bulan.',
            'insurance_fee.numeric' => 'Biaya asuransi harus berupa angka.',
            'insurance_fee.min' => 'Biaya asuransi tidak boleh kurang dari 0.',
            'additional_costs.numeric' => 'Biaya tambahan harus berupa angka.',
            'additional_costs.min' => 'Biaya tambahan tidak boleh kurang dari 0.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled(['motor_id', 'down_payment'])) {
                $motor = \App\Models\Motor::find($this->motor_id);
                if ($motor && $this->down_payment >= $motor->price) {
                    $validator->errors()->add('down_payment', 'Down payment tidak boleh lebih dari atau sama dengan harga motor.');
                }
                if ($motor && $this->down_payment < ($motor->price * 0.1)) {
                    $validator->errors()->add('down_payment', 'Down payment minimal 10% dari harga motor.');
                }
            }
        });
    }
}
