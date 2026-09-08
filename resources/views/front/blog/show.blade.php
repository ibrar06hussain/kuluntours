@extends('front.layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' - Kunlun Treks Journal')
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160))

@section('content')
<!-- Header -->
<section class="py-5 text-white position-relative" style="background: linear-gradient(135deg, #111418 0%, #1A1E24 60%, #8A0B14 100%); border-bottom: 3px solid var(--brand-gold);">
    <div class="container py-4 text-center">
        <div class="badge text-dark fw-bold mb-3" style="background: var(--brand-gold-gradient);"><i class="fas fa-newspaper me-1"></i>Expedition Journal</div>
        <h1 class="display-5 fw-bold font-heading text-white max-w-900 mx-auto mb-3">{{ $post->title }}</h1>
        <div class="text-light opacity-75 small">
            <span><i class="fas fa-user text-warning me-1"></i>By {{ $post->author->name ?? 'Kunlun Expedition Team' }}</span> •
            <span><i class="fas fa-calendar-alt text-warning me-1"></i>{{ $post->published_at ? $post->published_at->format('F d, Y') : '' }}</span>
        </div>
    </div>
</section>

<!-- Blog Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                @if($post->featured_image)
                    <div class="mb-4">
                        <img src="{{ Str::startsWith($post->featured_image, 'http') ? $post->featured_image : asset('uploads/' . $post->featured_image) }}" class="rounded-4 img-fluid w-100 shadow-sm" alt="{{ $post->title }}">
                    </div>
                @endif

                @if($post->excerpt)
                    <div class="p-4 rounded-3 bg-light border-start border-4 border-warning fst-italic lead fs-6 text-dark mb-4">
                        {{ $post->excerpt }}
                    </div>
                @endif

                <div class="post-content lead fs-6 text-secondary lh-lg mb-5">
                    {!! $post->content !!}
                </div>

                <div class="p-4 rounded-4 bg-light border d-flex justify-content-between align-items-center">
                    <div>
                        <span class="small text-muted d-block">Share this article</span>
                        <div class="d-flex gap-2 mt-1">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="fab fa-twitter"></i></a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-outline-success"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>All Articles
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-light mb-4 sticky-top" style="top: 90px;">
                    <h5 class="fw-bold font-heading mb-3">Recent Articles</h5>
                    <ul class="list-unstyled mb-4">
                        @foreach($recentPosts as $rPost)
                            <li class="mb-3 pb-3 border-bottom">
                                <a href="{{ route('blog.show', $rPost) }}" class="text-dark text-decoration-none fw-semibold small d-block mb-1">
                                    {{ $rPost->title }}
                                </a>
                                <small class="text-muted">{{ $rPost->published_at ? $rPost->published_at->format('M d, Y') : '' }}</small>
                            </li>
                        @endforeach
                    </ul>

                    <div class="p-3 bg-dark text-white rounded-3 text-center">
                        <h6 class="fw-bold text-warning mb-1">Plan Your Expedition</h6>
                        <p class="small text-muted mb-3">Speak with our high-altitude mountain leaders.</p>
                        <a href="{{ route('contact') }}" class="btn btn-brand-accent btn-sm w-100">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
