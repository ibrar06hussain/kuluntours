@extends('admin.layouts.app')

@section('title', 'Create Page')
@section('page-title', 'Create New Page')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Page Details</span>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Page Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. About Us, Visa Information" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Slug (optional)</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="auto-generated-if-blank">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Page Content (WYSIWYG) <span class="text-danger">*</span></label>
                        <textarea name="content" class="summernote form-control" required>{{ old('content') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Hero Banner / Featured Image (optional)</label>
                        <input type="file" name="featured_image" class="form-control" accept="image/*">
                    </div>

                    <hr class="my-4">
                    <h6 class="fw-bold mb-3 text-primary"><i class="fas fa-search me-2"></i>Search Engine Optimization (SEO)</h6>

                    <div class="mb-3">
                        <label class="form-label fw-bold">SEO Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">SEO Meta Description</label>
                        <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="isActive">Page is Active / Published</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>Save Page
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
