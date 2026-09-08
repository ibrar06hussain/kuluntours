@extends('admin.layouts.app')

@section('title', 'Add Slide')
@section('page-title', 'Add Hero Slide')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Slide Details</span>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero Slide Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. Conquer the Mighty Karakoram">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Subtitle / Tagline</label>
                        <textarea name="subtitle" rows="2" class="form-control" placeholder="e.g. Legendary Treks & Expeditions to K2, Broad Peak & Beyond">{{ old('subtitle') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Background Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                        <small class="text-muted">High resolution landscape wallpaper (1920x1080 recommended).</small>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">CTA Button Text</label>
                            <input type="text" name="button_text" class="form-control" value="{{ old('button_text', 'Explore Treks') }}" placeholder="e.g. Explore Treks">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">CTA Button URL</label>
                            <input type="text" name="button_url" class="form-control" value="{{ old('button_url', '/packages?category=trekking') }}" placeholder="e.g. /packages or /contact">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="isActive">Slide is Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>Save Slide
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
