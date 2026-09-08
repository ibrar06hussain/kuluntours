@extends('admin.layouts.app')

@section('title', 'Edit Section: ' . $homepageSection->title)
@section('page-title', 'Edit Homepage Section')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Section: <strong>{{ $homepageSection->title }}</strong> (<code>{{ $homepageSection->section_key }}</code>)</span>
                <a href="{{ route('admin.homepage-sections.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.homepage-sections.update', $homepageSection) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Section Heading / Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $homepageSection->title) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $homepageSection->sort_order) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Subtitle / Small Caption</label>
                        <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $homepageSection->subtitle) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Section Body Content (WYSIWYG)</label>
                        <textarea name="description" class="summernote form-control">{{ old('description', $homepageSection->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Side / Background Image</label>
                        @if($homepageSection->image)
                            <div class="mb-2">
                                <img src="{{ Str::startsWith($homepageSection->image, 'http') ? $homepageSection->image : asset('uploads/' . $homepageSection->image) }}" class="rounded img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave blank to keep existing image.</small>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $homepageSection->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="isActive">Display this section on Homepage</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.homepage-sections.index') }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>Update Section
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
