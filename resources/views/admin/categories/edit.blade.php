@extends('admin.layouts.app')

@section('title', 'Edit Category: ' . $category->name)
@section('page-title', 'Edit Category')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Edit Category: <strong>{{ $category->name }}</strong></span>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Font Awesome Icon Class</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="{{ $category->icon_class ?: 'fas fa-icons' }}"></i></span>
                                <input type="text" name="icon_class" class="form-control" value="{{ old('icon_class', $category->icon_class) }}" placeholder="e.g. fas fa-hiking">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $category->sort_order) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Cover Image</label>
                        @if($category->image)
                            <div class="mb-2">
                                <img src="{{ asset('uploads/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail rounded" style="max-height: 120px;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep existing cover image.</small>
                    </div>

                    <hr class="my-4">
                    <h6 class="fw-bold mb-3 text-primary"><i class="fas fa-search me-2"></i>Search Engine Optimization (SEO)</h6>

                    <div class="mb-3">
                        <label class="form-label fw-bold">SEO Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $category->meta_title) }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">SEO Meta Description</label>
                        <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description', $category->meta_description) }}</textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="isActive">Category is Active</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="show_in_menu" id="showInMenu" value="1" {{ old('show_in_menu', $category->show_in_menu) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="showInMenu">Show in Navigation Menu</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
