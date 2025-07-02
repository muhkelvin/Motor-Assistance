<?php

namespace App\Http\Controllers;

use App\Models\LeasingCompany;
use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    public function show($slug)
    {
        $motor = Motor::where('slug', $slug)
            ->with(['category', 'galleryImages']) // Pastikan relasi galleryImages ada
            ->firstOrFail();

        $relatedMotors = Motor::active()
            ->byCategory($motor->category_id)
            ->where('id', '!=', $motor->id)
            ->limit(4)
            ->get();

        $leasingCompanies = LeasingCompany::active()->get();

        return view('motors.show', compact('motor', 'relatedMotors', 'leasingCompanies'));
    }

    public function compare(Request $request)
    {
        $motorIds = $request->input('motors', []);

        if (count($motorIds) < 2 || count($motorIds) > 3) {
            return redirect()->back()->with('error', 'Pilih 2-3 motor untuk dibandingkan.');
        }

        $motors = Motor::active()
            ->whereIn('id', $motorIds)
            ->with(['category', 'images'])
            ->get();

        if ($motors->count() !== count($motorIds)) {
            return redirect()->back()->with('error', 'Motor yang dipilih tidak valid.');
        }

        return view('motors.compare', compact('motors'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return response()->json([]);
        }

        $motors = Motor::active()
            ->search($query)
            ->select('id', 'name', 'slug', 'price', 'main_image')
            ->limit(5)
            ->get();

        return response()->json($motors->map(function ($motor) {
            return [
                'id' => $motor->id,
                'name' => $motor->name,
                'slug' => $motor->slug,
                'price' => $motor->formatted_price,
                'image' => $motor->main_image_url,
                'url' => route('motors.show', $motor->slug)
            ];
        }));
    }
}
