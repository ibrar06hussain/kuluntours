@extends('admin.layouts.app')

@section('title', 'Write Article')
@section('page-title', 'Write New Blog Article')

@section('content')
<form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-lg-8">
            <div class="content-card mb-4">
                <div class="card-header">Article Content</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Article Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Ultimate Packing Guide for the K2 Base Camp Trek" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug (optional)</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="auto-generated-if-empty">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Excerpt / Summary</label>
                        <textarea name="excerpt" rows="3" class="form-control" placeholder="Short intro paragraph displayed in blog listing cards...">{{ old('excerpt') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Post Content (WYSIWYG) <span class="text-danger">*</span></label>
                        <textarea name="content" class="summernote form-control" required>{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="content-card mb-4">
                <div class="card-header"><i class="fas fa-search me-2"></i>SEO Settings</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">SEO Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold">SEO Description</label>
                        <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card mb-4">
                <div class="card-header">Publish Settings</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_published" id="isPublished" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isPublished">Publish Article</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Publish Date</label>
                        <input type="date" name="published_at" class="form-control" value="{{ old('published_at', date('Y-m-d')) }}">
                    </div>

                    <div class="d-grid gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-1"></i>Publish Post
                        </button>
                        <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </div>
            </div>

            <div class="content-card mb-4">
                <div class="card-header">Cover Photo</div>
                <div class="card-body">
                    <div class="mb-0">
                        <label class="form-label fw-bold">Featured Image</label>
                        <input type="file" name="featured_image" class="form-control" accept="image/*">
                        <small class="text-muted">High resolution landscape image (1200x700 recommended).</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
