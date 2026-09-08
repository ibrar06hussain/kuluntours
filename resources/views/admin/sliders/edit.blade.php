@extends('admin.layouts.app')

@section('title', 'Edit Slide')
@section('page-title', 'Edit Hero Slide')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Edit Slide: <strong>{{ $slider->title ?: 'Slide #' . $slider->id }}</strong></span>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero Slide Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Subtitle / Tagline</label>
                        <textarea name="subtitle" rows="2" class="form-control">{{ old('subtitle', $slider->subtitle) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Background Image</label>
                        <div class="mb-2">
                            <img src="{{ Str::startsWith($slider->image, 'http') ? $slider->image : asset('uploads/' . $slider->image) }}" alt="{{ $slider->title }}" class="img-thumbnail rounded w-100" style="max-height: 180px; object-fit: cover;">
                        </div>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave blank to keep existing background photo.</small>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">CTA Button Text</label>
                            <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $slider->button_text) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">CTA Button URL</label>
                            <input type="text" name="button_url" class="form-control" value="{{ old('button_url', $slider->button_url) }}">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $slider->sort_order) }}">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $slider->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="isActive">Slide is Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>Update Slide
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
