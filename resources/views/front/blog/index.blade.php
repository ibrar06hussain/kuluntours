@extends('front.layouts.app')

@section('title', 'Expedition Journal & Mountain Blog - Kunlun Treks and Tours')
@section('meta_description', 'High-altitude packing guides, Karakoram climbing routes, gear recommendations, and travel stories from Northern Pakistan.')

@section('content')
<!-- Header -->
<section class="py-5 bg-dark text-white position-relative" style="background: linear-gradient(180deg, #07151F 0%, #0C2333 100%);">
    <div class="container py-4 text-center">
        <span class="section-tag">Journal & Stories</span>
        <h1 class="display-4 fw-bold font-heading text-white mb-2">Expedition Journal</h1>
        <p class="text-light opacity-75 max-w-700 mx-auto">Expert mountaineering insights, packing guides, and Karakoram stories from our team.</p>
    </div>
</section>

<!-- Blog Listing -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="row g-4">
                    @forelse($posts as $post)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column bg-white">
                                @if($post->featured_image)
                                    <img src="{{ Str::startsWith($post->featured_image, 'http') ? $post->featured_image : asset('uploads/' . $post->featured_image) }}" class="card-img-top object-fit-cover" style="height: 220px;" alt="{{ $post->title }}">
                                @endif
                                <div class="card-body p-4 d-flex flex-column flex-grow-1">
                                    <div class="text-muted small mb-2"><i class="fas fa-calendar-alt text-warning me-1"></i>{{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}</div>
                                    <h5 class="fw-bold mb-2">
                                        <a href="{{ route('blog.show', $post) }}" class="text-dark text-decoration-none hover-accent">
                                            {{ $post->title }}
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-4 flex-grow-1">
                                        {{ Str::limit($post->excerpt ?: strip_tags($post->content), 120) }}
                                    </p>
                                    <a href="{{ route('blog.show', $post) }}" class="fw-bold text-primary text-decoration-none small">
                                        Read Full Article <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No journal posts available yet.</p>
                        </div>
                    @endforelse
                </div>

                @if($posts->hasPages())
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-light mb-4">
                    <h5 class="fw-bold font-heading mb-3">Recent Articles</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach($recentPosts as $rPost)
                            <li class="mb-3 pb-3 border-bottom">
                                <a href="{{ route('blog.show', $rPost) }}" class="text-dark text-decoration-none fw-semibold small d-block mb-1">
                                    {{ $rPost->title }}
                                </a>
                                <small class="text-muted">{{ $rPost->published_at ? $rPost->published_at->format('M d, Y') : '' }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 text-white" style="background: linear-gradient(180deg, #0C2333 0%, #163B54 100%);">
                    <h5 class="fw-bold text-white font-heading mb-2">Ready for K2?</h5>
                    <p class="small text-light opacity-75 mb-3">Join our upcoming Baltoro Glacier & Concordia Trek with experienced mountain guides.</p>
                    <a href="{{ route('packages.index') }}" class="btn btn-brand-accent btn-sm fw-bold">Explore Treks</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
