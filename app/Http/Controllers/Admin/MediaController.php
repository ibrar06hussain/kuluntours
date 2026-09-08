<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected MediaService $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        $mediaItems = Media::latest()->paginate(24);
        return view('admin.media.index', compact('mediaItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpeg,png,jpg,webp,pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = $this->mediaService->upload($file, 'library');
                Media::create([
                    'filename' => $filename,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'user_id' => auth()->id() ?? 1,
                ]);
            }
        }

        return redirect()->route('admin.media.index')->with('success', 'Files uploaded successfully.');
    }

    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $path = $this->mediaService->upload($request->file('image'), 'editor');
            $url = $this->mediaService->url($path);
            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'No image provided'], 400);
    }

    public function destroy(Media $media)
    {
        $this->mediaService->delete($media->filename);
        $media->delete();

        return redirect()->route('admin.media.index')->with('success', 'Media file deleted.');
    }
}
