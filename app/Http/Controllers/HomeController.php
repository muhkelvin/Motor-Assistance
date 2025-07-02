<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Motor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredMotors = Motor::active()
            ->featured()
            ->with(['category', 'images'])
            ->limit(6)
            ->get();

        $categories = Category::active()
            ->ordered()
            ->withCount('activeMotors')
            ->get();

        $latestMotors = Motor::active()
            ->with(['category'])
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('home', compact('featuredMotors', 'categories', 'latestMotors'));
    }
}
