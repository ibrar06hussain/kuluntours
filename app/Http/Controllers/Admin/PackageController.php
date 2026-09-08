<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\PackageImage;
use App\Models\PackageInclusion;
use App\Models\PackageItinerary;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    protected MediaService $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index(Request $request)
    {
        $query = Package::with('category')->withCount(['images', 'itineraries']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $packages = $query->orderBy('sort_order')->paginate(12)->withQueryString();
        $categories = Category::active()->get();

        return view('admin.packages.index', compact('packages', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.packages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:packages,slug',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'duration_days' => 'nullable|integer|min:1',
            'max_altitude' => 'nullable|string|max:100',
            'difficulty_level' => 'nullable|in:easy,moderate,difficult,extreme',
            'best_season' => 'nullable|string|max:255',
            'group_size' => 'nullable|string|max:100',
            'starting_point' => 'nullable|string|max:255',
            'ending_point' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_note' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'is_fixed_departure' => 'nullable|boolean',
            'departure_date' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_fixed_departure'] = $request->has('is_fixed_departure');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->mediaService->upload($request->file('featured_image'), 'packages');
        }

        $package = Package::create($validated);

        // Process Itineraries
        if ($request->has('itineraries') && is_array($request->itineraries)) {
            foreach ($request->itineraries as $idx => $itn) {
                if (!empty($itn['title'])) {
                    PackageItinerary::create([
                        'package_id' => $package->id,
                        'day_number' => $itn['day_number'] ?? ($idx + 1),
                        'title' => $itn['title'],
                        'description' => $itn['description'] ?? '',
                        'sort_order' => $idx + 1,
                    ]);
                }
            }
        }

        // Process Inclusions
        if ($request->has('inclusions') && is_array($request->inclusions)) {
            foreach ($request->inclusions as $idx => $inc) {
                if (!empty($inc['description'])) {
                    PackageInclusion::create([
                        'package_id' => $package->id,
                        'type' => 'inclusion',
                        'description' => $inc['description'],
                        'sort_order' => $idx + 1,
                    ]);
                }
            }
        }

        // Process Exclusions
        if ($request->has('exclusions') && is_array($request->exclusions)) {
            foreach ($request->exclusions as $idx => $exc) {
                if (!empty($exc['description'])) {
                    PackageInclusion::create([
                        'package_id' => $package->id,
                        'type' => 'exclusion',
                        'description' => $exc['description'],
                        'sort_order' => $idx + 1,
                    ]);
                }
            }
        }

        // Process Gallery Images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $idx => $file) {
                $imgPath = $this->mediaService->upload($file, 'packages/gallery');
                PackageImage::create([
                    'package_id' => $package->id,
                    'image' => $imgPath,
                    'caption' => $package->title,
                    'sort_order' => $idx + 1,
                ]);
            }
        }

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        $package->load(['images', 'itineraries', 'inclusions', 'exclusions']);
        $categories = Category::active()->get();
        return view('admin.packages.edit', compact('package', 'categories'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:packages,slug,' . $package->id,
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'duration_days' => 'nullable|integer|min:1',
            'max_altitude' => 'nullable|string|max:100',
            'difficulty_level' => 'nullable|in:easy,moderate,difficult,extreme',
            'best_season' => 'nullable|string|max:255',
            'group_size' => 'nullable|string|max:100',
            'starting_point' => 'nullable|string|max:255',
            'ending_point' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_note' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'is_fixed_departure' => 'nullable|boolean',
            'departure_date' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_fixed_departure'] = $request->has('is_fixed_departure');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('featured_image')) {
            if ($package->featured_image) {
                $this->mediaService->delete($package->featured_image);
            }
            $validated['featured_image'] = $this->mediaService->upload($request->file('featured_image'), 'packages');
        }

        $package->update($validated);

        // Update Itineraries
        if ($request->has('itineraries')) {
            $package->itineraries()->delete();
            foreach ($request->itineraries as $idx => $itn) {
                if (!empty($itn['title'])) {
                    PackageItinerary::create([
                        'package_id' => $package->id,
                        'day_number' => $itn['day_number'] ?? ($idx + 1),
                        'title' => $itn['title'],
                        'description' => $itn['description'] ?? '',
                        'sort_order' => $idx + 1,
                    ]);
                }
            }
        }

        // Update Inclusions & Exclusions
        if ($request->has('inclusions') || $request->has('exclusions')) {
            $package->allInclusions()->delete();

            if ($request->has('inclusions') && is_array($request->inclusions)) {
                foreach ($request->inclusions as $idx => $inc) {
                    if (!empty($inc['description'])) {
                        PackageInclusion::create([
                            'package_id' => $package->id,
                            'type' => 'inclusion',
                            'description' => $inc['description'],
                            'sort_order' => $idx + 1,
                        ]);
                    }
                }
            }

            if ($request->has('exclusions') && is_array($request->exclusions)) {
                foreach ($request->exclusions as $idx => $exc) {
                    if (!empty($exc['description'])) {
                        PackageInclusion::create([
                            'package_id' => $package->id,
                            'type' => 'exclusion',
                            'description' => $exc['description'],
                            'sort_order' => $idx + 1,
                        ]);
                    }
                }
            }
        }

        // Add New Gallery Images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $idx => $file) {
                $imgPath = $this->mediaService->upload($file, 'packages/gallery');
                PackageImage::create([
                    'package_id' => $package->id,
                    'image' => $imgPath,
                    'caption' => $package->title,
                    'sort_order' => $package->images()->count() + $idx + 1,
                ]);
            }
        }

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function deleteGalleryImage(PackageImage $image)
    {
        $this->mediaService->delete($image->image);
        $image->delete();
        return back()->with('success', 'Gallery image deleted.');
    }

    public function destroy(Package $package)
    {
        if ($package->featured_image) {
            $this->mediaService->delete($package->featured_image);
        }
        foreach ($package->images as $img) {
            $this->mediaService->delete($img->image);
        }
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}
