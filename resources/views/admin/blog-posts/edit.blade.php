@extends('admin.layouts.app')

@section('title', 'Edit Article: ' . $blogPost->title)
@section('page-title', 'Edit Blog Article')

@section('content')
<form action="{{ route('admin.blog-posts.update', $blogPost) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-8">
            <div class="content-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Article: <strong>{{ $blogPost->title }}</strong></span>
                    <a href="{{ route('blog.show', $blogPost) }}" target="_blank" class="btn btn-sm btn-outline-info">
                        <i class="fas fa-external-link-alt me-1"></i>View Live
                    </a>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Article Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $blogPost->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $blogPost->slug) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Excerpt / Summary</label>
                        <textarea name="excerpt" rows="3" class="form-control">{{ old('excerpt', $blogPost->excerpt) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Post Content (WYSIWYG) <span class="text-danger">*</span></label>
                        <textarea name="content" class="summernote form-control" required>{{ old('content', $blogPost->content) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="content-card mb-4">
                <div class="card-header"><i class="fas fa-search me-2"></i>SEO Settings</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">SEO Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $blogPost->meta_title) }}">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold">SEO Description</label>
                        <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description', $blogPost->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card mb-4">
                <div class="card-header">Publish Settings</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_published" id="isPublished" value="1" {{ old('is_published', $blogPost->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isPublished">Publish Article</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Publish Date</label>
                        <input type="date" name="published_at" class="form-control" value="{{ old('published_at', $blogPost->published_at ? $blogPost->published_at->format('Y-m-d') : date('Y-m-d')) }}">
                    </div>

                    <div class="d-grid gap-2 pt-2 border-top">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-1"></i>Update Post
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
                        @if($blogPost->featured_image)
                            <div class="mb-2">
                                <img src="{{ Str::startsWith($blogPost->featured_image, 'http') ? $blogPost->featured_image : asset('uploads/' . $blogPost->featured_image) }}" class="rounded img-thumbnail w-100" style="max-height: 150px; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="featured_image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep existing image.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
