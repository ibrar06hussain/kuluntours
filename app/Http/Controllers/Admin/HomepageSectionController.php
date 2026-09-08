<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use App\Services\MediaService;
use Illuminate\Http\Request;

class HomepageSectionController extends Controller
{
    protected MediaService $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        $sections = HomepageSection::orderBy('sort_order')->get();
        return view('admin.homepage-sections.index', compact('sections'));
    }

    public function edit(HomepageSection $homepageSection)
    {
        return view('admin.homepage-sections.edit', compact('homepageSection'));
    }

    public function update(Request $request, HomepageSection $homepageSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            if ($homepageSection->image) {
                $this->mediaService->delete($homepageSection->image);
            }
            $validated['image'] = $this->mediaService->upload($request->file('image'), 'sections');
        }

        $homepageSection->update($validated);

        return redirect()->route('admin.homepage-sections.index')->with('success', 'Homepage section updated successfully.');
    }
}
