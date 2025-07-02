<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^[0-9+\-\s()]+$/|min:10|max:20',
            'email' => 'nullable|email|max:255',
            'city' => 'nullable|string|max:100',
            'preferred_contact_time' => 'required|in:morning,afternoon,evening,anytime',
            'motor_id' => 'required|exists:motors,id',
            'credit_simulation_id' => 'nullable|exists:credit_simulations,id',
            'notes' => 'nullable|string|max:1000',
            'source' => 'nullable|string|max:50'
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Nama lengkap harus diisi.',
            'customer_name.string' => 'Nama lengkap harus berupa teks.',
            'customer_name.max' => 'Nama lengkap maksimal 255 karakter.',

            'phone.required' => 'Nomor telepon harus diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.regex' => 'Format nomor telepon tidak valid.',
            'phone.min' => 'Nomor telepon minimal 10 karakter.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',

            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',

            'city.string' => 'Kota harus berupa teks.',
            'city.max' => 'Kota maksimal 100 karakter.',

            'preferred_contact_time.required' => 'Waktu kontak yang diinginkan harus dipilih.',
            'preferred_contact_time.in' => 'Waktu kontak yang dipilih tidak valid.',

            'motor_id.required' => 'Motor harus dipilih.',
            'motor_id.exists' => 'Motor yang dipilih tidak valid.',

            'credit_simulation_id.exists' => 'Simulasi kredit yang dipilih tidak valid.',

            'notes.string' => 'Catatan harus berupa teks.',
            'notes.max' => 'Catatan maksimal 1000 karakter.',

            'source.string' => 'Sumber harus berupa teks.',
            'source.max' => 'Sumber maksimal 50 karakter.'
        ];
    }

    protected function prepareForValidation()
    {
        // Clean phone number
        if ($this->filled('phone')) {
            $phone = preg_replace('/[^0-9+]/', '', $this->phone);

            // Convert Indonesian phone format
            if (str_starts_with($phone, '08')) {
                $phone = '+62' . substr($phone, 1);
            } elseif (str_starts_with($phone, '8')) {
                $phone = '+62' . $phone;
            }

            $this->merge(['phone' => $phone]);
        }

        // Set default source if not provided
        if (!$this->filled('source')) {
            $this->merge(['source' => 'website']);
        }
    }
}
