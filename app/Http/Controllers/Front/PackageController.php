<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::active()->with('category');

        if ($request->filled('category')) {
            $categorySlug = $request->category;
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty_level', $request->difficulty);
        }

        if ($request->filled('duration')) {
            $duration = $request->duration;
            if ($duration === '1-7') {
                $query->whereBetween('duration_days', [1, 7]);
            } elseif ($duration === '8-14') {
                $query->whereBetween('duration_days', [8, 14]);
            } elseif ($duration === '15-21') {
                $query->whereBetween('duration_days', [15, 21]);
            } elseif ($duration === '22+') {
                $query->where('duration_days', '>=', 22);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('starting_point', 'like', "%{$search}%");
            });
        }

        $packages = $query->paginate(9)->withQueryString();
        $categories = Category::active()->withCount('activePackages')->get();
        $currentCategory = $request->filled('category') ? Category::where('slug', $request->category)->first() : null;

        return view('front.packages.index', compact('packages', 'categories', 'currentCategory'));
    }

    public function category(Category $category)
    {
        $packages = Package::active()
            ->where('category_id', $category->id)
            ->paginate(9);

        $categories = Category::active()->withCount('activePackages')->get();
        $currentCategory = $category;

        return view('front.packages.index', compact('packages', 'categories', 'currentCategory'));
    }

    public function show(Package $package)
    {
        if (!$package->is_active) {
            abort(404);
        }

        $package->load(['category', 'images', 'itineraries', 'inclusions', 'exclusions']);
        $relatedPackages = Package::active()
            ->where('category_id', $package->category_id)
            ->where('id', '!=', $package->id)
            ->take(3)
            ->get();

        return view('front.packages.show', compact('package', 'relatedPackages'));
    }
}
