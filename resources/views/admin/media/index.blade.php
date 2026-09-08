@extends('admin.layouts.app')

@section('title', 'Media Library')
@section('page-title', 'Media Library & Assets')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Upload and manage images, PDFs, and expedition documents.</p>
</div>

<!-- Upload Box -->
<div class="content-card mb-4">
    <div class="card-header"><i class="fas fa-cloud-upload-alt text-primary me-2"></i>Upload New Files</div>
    <div class="card-body">
        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-center">
            @csrf
            <div class="col-md-9">
                <input type="file" name="files[]" class="form-control" multiple required>
                <small class="text-muted">Supports JPG, PNG, WEBP, PDF, DOCX up to 10MB each.</small>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload me-1"></i>Upload Files
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Media Grid -->
<div class="content-card">
    <div class="card-header">Uploaded Assets ({{ $mediaItems->total() }})</div>
    <div class="card-body">
        <div class="row g-3">
            @forelse($mediaItems as $media)
                <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                    <div class="card h-100 border shadow-none position-relative group">
                        @if(Str::startsWith($media->mime_type, 'image/'))
                            <img src="{{ asset('uploads/' . $media->filename) }}" class="card-img-top object-fit-cover" style="height: 120px;" alt="{{ $media->original_name }}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 120px;">
                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                            </div>
                        @endif
                        <div class="card-body p-2">
                            <div class="small fw-semibold text-truncate" title="{{ $media->original_name }}">{{ $media->original_name }}</div>
                            <div class="text-muted" style="font-size: 0.72rem;">{{ number_format($media->size / 1024, 1) }} KB</div>
                        </div>
                        <div class="card-footer bg-white border-top p-1 d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-xs btn-outline-secondary copy-url-btn py-0 px-2" style="font-size: 0.7rem;" data-url="{{ asset('uploads/' . $media->filename) }}">
                                <i class="fas fa-copy me-1"></i>URL
                            </button>
                            <form action="{{ route('admin.media.destroy', $media) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this media file?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-outline-danger py-0 px-2" style="font-size: 0.7rem;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fas fa-photo-video fa-3x mb-3 d-block text-secondary"></i>
                    No media items uploaded yet.
                </div>
            @endforelse
        </div>
    </div>
    @if($mediaItems->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $mediaItems->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    $('.copy-url-btn').on('click', function() {
        let url = $(this).data('url');
        navigator.clipboard.writeText(url).then(() => {
            alert('File URL copied to clipboard: ' + url);
        });
    });
</script>
@endpush
