<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\CreditSimulation;
use App\Models\Inquiry;
use App\Models\Motor;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function create(Request $request)
    {
        $motor = null;
        $simulation = null;

        if ($request->filled('motor_id')) {
            $motor = Motor::findOrFail($request->motor_id);
        }

        if ($request->filled('simulation_id')) {
            $simulation = CreditSimulation::with(['motor', 'leasingCompany'])
                ->findOrFail($request->simulation_id);
            $motor = $simulation->motor;
        }

        return view('inquiry.create', compact('motor', 'simulation'));
    }

    public function store(StoreInquiryRequest $request)
    {
        $inquiry = Inquiry::create($request->validated());

        // Send WhatsApp notification (you can implement this later)
        // $this->sendWhatsAppNotification($inquiry);

        return redirect()->route('inquiry.success')
            ->with('success', 'Terima kasih! Inquiry Anda telah dikirim. Tim kami akan menghubungi Anda segera.');
    }

    public function success()
    {
        return view('inquiry.success');
    }

    private function sendWhatsAppNotification(Inquiry $inquiry)
    {
        // Implementation for WhatsApp API integration
        // This can be done using services like Twilio, WhatsBom, or custom WhatsApp Business API

        $message = "Inquiry Baru!\n\n";
        $message .= "Nama: {$inquiry->customer_name}\n";
        $message .= "Phone: {$inquiry->phone}\n";
        $message .= "Motor: {$inquiry->motor->name}\n";
        $message .= "Waktu: " . $inquiry->created_at->format('d/m/Y H:i') . "\n";

        if ($inquiry->creditSimulation) {
            $message .= "Simulasi Kredit: {$inquiry->creditSimulation->formatted_monthly_payment}/bulan\n";
        }

        if ($inquiry->notes) {
            $message .= "Catatan: {$inquiry->notes}\n";
        }

        // Send to dealer WhatsApp number
        // Implementation depends on your chosen WhatsApp service
    }
}
