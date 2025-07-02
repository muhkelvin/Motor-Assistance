<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Motor;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Motor::active()->with(['category', 'images']);

        // Category filter
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Price range filter
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->priceRange($request->min_price, $request->max_price);
        }

        // Engine CC filter
        if ($request->filled('min_cc') && $request->filled('max_cc')) {
            $query->engineRange($request->min_cc, $request->max_cc);
        }

        // Year filter
        if ($request->filled('year')) {
            $query->byYear($request->year);
        }

        // Search filter
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Color filter
        if ($request->filled('color')) {
            $query->whereJsonContains('colors', $request->color);
        }

        // Features filter
        if ($request->filled('features')) {
            foreach ($request->features as $feature) {
                $query->whereJsonContains('features', $feature);
            }
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');

        switch ($sortBy) {
            case 'price':
                $query->orderBy('price', $sortOrder);
                break;
            case 'engine_cc':
                $query->orderBy('engine_cc', $sortOrder);
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'popularity':
                $query->withCount('inquiries')->orderBy('inquiries_count', 'desc');
                break;
            default:
                $query->orderBy('name', $sortOrder);
        }

        $motors = $query->paginate(12)->withQueryString();

        $categories = Category::active()->ordered()->get();
        $years = Motor::active()->distinct()->pluck('model_year')->sort()->values();
        $availableColors = Motor::active()->get()->pluck('colors')->flatten()->unique()->values();
        $availableFeatures = Motor::active()->get()->pluck('features')->flatten()->unique()->values();

        return view('catalog.index', compact(
            'motors',
            'categories',
            'years',
            'availableColors',
            'availableFeatures'
        ));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $motors = Motor::active()
            ->byCategory($category->id)
            ->with(['category', 'images'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12);

        return view('catalog.category', compact('category', 'motors'));
    }
}
