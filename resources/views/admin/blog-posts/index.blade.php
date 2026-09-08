@extends('admin.layouts.app')

@section('title', 'Blog Posts')
@section('page-title', 'Expedition Articles & Blog Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Publish trekking guides, Karakoram gear advice, summit stories, and travel updates.</p>
    <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Write New Post
    </a>
</div>

<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">Cover</th>
                        <th>Article Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td>
                            @if($post->featured_image)
                                <img src="{{ Str::startsWith($post->featured_image, 'http') ? $post->featured_image : asset('uploads/' . $post->featured_image) }}" alt="{{ $post->title }}" class="rounded shadow-sm object-fit-cover" style="width: 60px; height: 45px;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 45px;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $post->title }}</div>
                            <small class="text-muted">{{ Str::limit($post->excerpt, 70) }}</small>
                        </td>
                        <td>
                            <span class="small fw-semibold text-dark">{{ $post->author->name ?? 'Admin' }}</span>
                        </td>
                        <td>
                            <span class="small text-muted">{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}</span>
                        </td>
                        <td>
                            @if($post->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('blog.show', $post) }}" target="_blank" class="btn btn-sm btn-outline-info me-1">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <a href="{{ route('admin.blog-posts.edit', $post) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this blog post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-newspaper fa-3x mb-3 d-block text-secondary"></i>
                            No blog posts written yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($posts->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
