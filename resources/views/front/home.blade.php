@extends('front.layouts.app')

@section('title', 'Kunlun Treks and Tours - Premier Karakoram & Himalayan Adventures')
@section('meta_description', 'Experience the raw grandeur of Pakistan\'s Karakoram, Himalayas, and Hindukush. Expert guided K2 Base Camp treks, peak expeditions, and cultural tours.')

@section('content')
<!-- Hero Slider -->
@if($sliders->count() > 0)
<section class="hero-slider-section position-relative">
    <div id="heroCarousel" class="carousel slide carousel-fade hero-slider" data-bs-ride="carousel" data-bs-interval="6000">
        <div class="carousel-indicators">
            @foreach($sliders as $idx => $slider)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $idx }}" class="{{ $idx == 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($sliders as $idx => $slider)
                <div class="carousel-item {{ $idx == 0 ? 'active' : '' }}">
                    <img src="{{ Str::startsWith($slider->image, 'http') ? $slider->image : asset('uploads/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}">
                    <div class="hero-overlay">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    @if($slider->title)
                                        <h1 class="hero-title mb-3">{{ $slider->title }}</h1>
                                    @endif
                                    @if($slider->subtitle)
                                        <p class="hero-subtitle mb-4">{{ $slider->subtitle }}</p>
                                    @endif
                                    @if($slider->button_text)
                                        <div class="d-flex flex-wrap gap-3">
                                            <a href="{{ $slider->button_url ?: route('packages.index') }}" class="btn btn-brand-accent btn-lg px-4 shadow">
                                                {{ $slider->button_text }} <i class="fas fa-arrow-right ms-2"></i>
                                            </a>
                                            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4">
                                                <i class="fas fa-calendar-alt me-2"></i>Plan Custom Trek
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>
@endif

<!-- Quick Search / Filter Bar -->
<section class="py-4 shadow-lg" style="margin-top: -35px; position: relative; z-index: 20; border-radius: 14px; margin-left: auto; margin-right: auto; max-width: 1200px; background: linear-gradient(135deg, #111418 0%, #1A1E24 100%); border-top: 3px solid var(--brand-gold); border-bottom: 2px solid var(--brand-red);">
    <div class="container px-4">
        <form action="{{ route('packages.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-lg-3 col-md-6">
                <label class="small fw-bold mb-1" style="color: var(--brand-gold-light);"><i class="fas fa-map-marker-alt me-1 text-danger"></i>Destination / Region</label>
                <input type="text" name="search" class="form-control form-control-sm border-0 text-white" style="background-color: #262B33;" placeholder="e.g. K2, Concordia, Hunza">
            </div>
            <div class="col-lg-3 col-md-6">
                <label class="small fw-bold mb-1" style="color: var(--brand-gold-light);"><i class="fas fa-layer-group me-1 text-danger"></i>Adventure Type</label>
                <select name="category" class="form-select form-select-sm border-0 text-white" style="background-color: #262B33;">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-6">
                <label class="small fw-bold mb-1" style="color: var(--brand-gold-light);"><i class="fas fa-mountain me-1 text-danger"></i>Difficulty Level</label>
                <select name="difficulty" class="form-select form-select-sm border-0 text-white" style="background-color: #262B33;">
                    <option value="">Any Difficulty</option>
                    <option value="easy">Easy (Cultural / Leisure)</option>
                    <option value="moderate">Moderate (Alpine Treks)</option>
                    <option value="difficult">Difficult (Glacier Treks)</option>
                    <option value="extreme">Extreme (Peak Climbing)</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 d-grid pt-lg-3">
                <button type="submit" class="btn btn-brand-primary btn-sm py-2">
                    <i class="fas fa-search me-1"></i>Find Expeditions
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Adventure Categories Grid -->
<section class="py-5 my-3">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-tag">Explore By Experience</span>
            <h2 class="section-title">Adventures in the Karakoram & Himalayas</h2>
            <p class="text-muted max-w-700 mx-auto">From peaceful alpine meadows to grueling 8,000m summits, choose your mountain dream.</p>
        </div>

        <div class="row g-4">
            @foreach($categories as $cat)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('packages.category', $cat) }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 position-relative category-card group" style="background: linear-gradient(145deg, #111418 0%, #1A1E24 60%, #8A0B14 100%); transition: all 0.3s; border-bottom: 3px solid var(--brand-gold) !important;">
                            <div class="card-body p-4 text-white d-flex flex-column justify-content-between" style="min-height: 220px;">
                                <div>
                                    <div class="d-inline-flex align-items-center justify-content-center text-dark rounded-circle p-3 mb-3 shadow" style="width: 55px; height: 55px; background: var(--brand-gold-gradient);">
                                        <i class="{{ $cat->icon_class ?: 'fas fa-hiking' }} fs-4 text-dark"></i>
                                    </div>
                                    <h4 class="text-white fw-bold mb-2 font-heading">{{ $cat->name }}</h4>
                                    <p class="text-light small opacity-75 mb-0">{{ Str::limit($cat->description, 85) }}</p>
                                </div>
                                <div class="mt-3 pt-3 border-top border-secondary-subtle d-flex justify-content-between align-items-center">
                                    <span class="small fw-semibold" style="color: var(--brand-gold-light);">{{ $cat->activePackages->count() }} Trips Available</span>
                                    <span class="text-warning"><i class="fas fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Packages -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end mb-4">
            <div>
                <span class="section-tag">Handcrafted Itineraries</span>
                <h2 class="section-title mb-0">Featured Expeditions & Treks</h2>
            </div>
            <a href="{{ route('packages.index') }}" class="btn btn-outline-brand mt-3 mt-md-0">
                View All Trips <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($featuredPackages as $pkg)
                <div class="col-lg-4 col-md-6">
                    <div class="package-card">
                        <div class="package-card-img-wrapper">
                            <img src="{{ Str::startsWith($pkg->featured_image, 'http') ? $pkg->featured_image : asset('uploads/' . $pkg->featured_image) }}" alt="{{ $pkg->title }}">
                            <span class="package-badge-category">{{ $pkg->category->name ?? 'Trek' }}</span>
                            @if($pkg->price)
                                <span class="package-badge-price">PKR {{ number_format($pkg->price, 0) }}</span>
                            @endif
                        </div>
                        <div class="package-card-body">
                            <div class="d-flex gap-3 mb-2">
                                <span class="package-meta-item"><i class="fas fa-clock"></i>{{ $pkg->duration_days }} Days</span>
                                <span class="package-meta-item"><i class="fas fa-chart-line"></i>{{ ucfirst($pkg->difficulty_level ?? 'Moderate') }}</span>
                                @if($pkg->max_altitude)
                                    <span class="package-meta-item"><i class="fas fa-mountain"></i>{{ Str::limit($pkg->max_altitude, 10) }}</span>
                                @endif
                            </div>

                            <h5 class="fw-bold mb-2">
                                <a href="{{ route('packages.show', $pkg) }}" class="text-dark text-decoration-none hover-accent">
                                    {{ $pkg->title }}
                                </a>
                            </h5>

                            <p class="text-muted small mb-4 flex-grow-1">
                                {{ Str::limit($pkg->short_description ?: strip_tags($pkg->description), 95) }}
                            </p>

                            <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                                <span class="text-muted small"><i class="fas fa-map-marker-alt text-danger me-1"></i>{{ Str::limit($pkg->location ?: $pkg->starting_point, 18) }}</span>
                                <a href="{{ route('packages.show', $pkg) }}" class="btn btn-sm btn-brand-primary">
                                    Explore Itinerary <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">No featured expeditions found.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- About Intro Section (Dynamic from Database) -->
@if(isset($sections['about_intro']))
<section class="py-5">
    <div class="container py-lg-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                @if($sections['about_intro']->image)
                    <div class="position-relative">
                        <img src="{{ Str::startsWith($sections['about_intro']->image, 'http') ? $sections['about_intro']->image : asset('uploads/' . $sections['about_intro']->image) }}" class="rounded-4 shadow-lg w-100 object-fit-cover" style="min-height: 420px;" alt="{{ $sections['about_intro']->title }}">
                        <div class="position-absolute bottom-0 start-0 m-4 p-3 bg-dark text-white rounded-3 shadow d-none d-md-block" style="background: rgba(7, 21, 31, 0.85) !important; backdrop-filter: blur(8px);">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-award fa-2x text-warning"></i>
                                <div>
                                    <div class="fw-bold">20+ Years Excellence</div>
                                    <small class="text-muted">Karakoram & Himalayan Mountaineering</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                <span class="section-tag">{{ $sections['about_intro']->subtitle ?? 'About Kunlun Treks' }}</span>
                <h2 class="section-title mb-4">{{ $sections['about_intro']->title }}</h2>
                <div class="lead fs-6 text-muted mb-4 lh-lg">
                    {!! $sections['about_intro']->description !!}
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('pages.show', 'about-us') }}" class="btn btn-brand-primary px-4">
                        Read Our Story <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-brand px-4">
                        Get In Touch
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Why Choose Us Section (Dynamic from Database) -->
@if(isset($sections['why_choose_us']))
<section class="why-choose-us-section py-5 text-white" style="background: linear-gradient(135deg, #1e2633 0%, #252e3e 50%, #4a151b 100%); border-top: 2px solid var(--brand-gold); border-bottom: 2px solid var(--brand-gold);">
    <div class="container py-4">
        <div class="section-header text-center">
            <span class="section-tag" style="color: var(--brand-gold-light);">{{ $sections['why_choose_us']->subtitle ?? 'The Kunlun Difference' }}</span>
            <h2 class="section-title text-white">{{ $sections['why_choose_us']->title }}</h2>
        </div>

        <div class="text-white">
            {!! $sections['why_choose_us']->description !!}
        </div>
    </div>
</section>
<style>
    .why-choose-us-section .text-muted,
    .why-choose-us-section p {
        color: #d1d5db !important;
    }
    .why-choose-us-section h5 {
        color: #ffffff !important;
        font-weight: 700;
    }
</style>
@endif

<!-- Fixed Departures Highlight -->
@if($fixedDepartures->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-tag">Join A Group</span>
            <h2 class="section-title">Upcoming Fixed Departures 2026</h2>
            <p class="text-muted max-w-700 mx-auto">Guaranteed departures with confirmed international groups. Secure your spot on the team.</p>
        </div>

        <div class="row g-4">
            @foreach($fixedDepartures as $pkg)
                <div class="col-lg-6">
                    <div class="card border rounded-4 p-4 shadow-sm h-100 d-flex flex-column flex-md-row gap-4 align-items-center">
                        <img src="{{ Str::startsWith($pkg->featured_image, 'http') ? $pkg->featured_image : asset('uploads/' . $pkg->featured_image) }}" class="rounded-3 object-fit-cover shadow-sm" style="width: 140px; height: 140px;" alt="{{ $pkg->title }}">
                        <div class="flex-grow-1">
                            @if($pkg->departure_date)
                                <div class="badge bg-danger-subtle text-danger fw-bold mb-2">
                                    <i class="fas fa-calendar-alt me-1"></i>Departing: {{ $pkg->departure_date->format('F d, Y') }}
                                </div>
                            @endif
                            <h5 class="fw-bold mb-1">
                                <a href="{{ route('packages.show', $pkg) }}" class="text-dark text-decoration-none">{{ $pkg->title }}</a>
                            </h5>
                            <div class="small text-muted mb-3">
                                <span><i class="fas fa-clock text-warning me-1"></i>{{ $pkg->duration_days }} Days</span> •
                                <span><i class="fas fa-tag text-success me-1"></i>PKR {{ number_format($pkg->price, 0) }}</span> •
                                <span><i class="fas fa-users text-primary me-1"></i>{{ $pkg->group_size ?: 'Small Group' }}</span>
                            </div>
                            <a href="{{ route('packages.show', $pkg) }}" class="btn btn-sm btn-brand-accent">
                                Book This Group <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Testimonials Carousel -->
@if($testimonials->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="section-header text-center">
            <span class="section-tag">Client Stories</span>
            <h2 class="section-title">What Climbers & Trekkers Say</h2>
        </div>

        <div class="row g-4">
            @foreach($testimonials as $t)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white d-flex flex-column justify-content-between">
                        <div>
                            <div class="text-warning mb-3">
                                @for($i=0; $i<$t->rating; $i++) <i class="fas fa-star"></i> @endfor
                            </div>
                            <p class="text-secondary small fst-italic mb-4 lh-lg">"{{ $t->content }}"</p>
                        </div>
                        <div class="d-flex align-items-center gap-3 pt-3 border-top">
                            @if($t->photo)
                                <img src="{{ Str::startsWith($t->photo, 'http') ? $t->photo : asset('uploads/' . $t->photo) }}" class="rounded-circle object-fit-cover" style="width: 50px; height: 50px;" alt="{{ $t->client_name }}">
                            @else
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px;">
                                    {{ substr($t->client_name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <div class="fw-bold text-dark">{{ $t->client_name }}</div>
                                <small class="text-muted">{{ $t->company ?: 'International Climber' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Journal / Blog Articles -->
@if(isset($latestPosts) && $latestPosts->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end mb-4">
            <div>
                <span class="section-tag">Mountaineering Insights</span>
                <h2 class="section-title mb-0">From Our Expedition Journal</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-outline-brand mt-3 mt-md-0">
                View All Articles <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($latestPosts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column">
                        @if($post->featured_image)
                            <img src="{{ Str::startsWith($post->featured_image, 'http') ? $post->featured_image : asset('uploads/' . $post->featured_image) }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $post->title }}">
                        @endif
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fas fa-calendar-alt text-warning me-1"></i>{{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}</div>
                            <h5 class="fw-bold mb-2">
                                <a href="{{ route('blog.show', $post) }}" class="text-dark text-decoration-none hover-accent">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <p class="text-muted small mb-4 flex-grow-1">
                                {{ Str::limit($post->excerpt ?: strip_tags($post->content), 110) }}
                            </p>
                            <a href="{{ route('blog.show', $post) }}" class="fw-bold text-primary text-decoration-none small">
                                Read Article <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Call to Action Banner (Dynamic from Database) -->
@if(isset($sections['cta_banner']))
<section class="py-5 text-white text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, rgba(7,21,31,0.85) 0%, rgba(12,35,51,0.95) 100%), url('{{ $sections['cta_banner']->image ? (Str::startsWith($sections['cta_banner']->image, 'http') ? $sections['cta_banner']->image : asset('uploads/' . $sections['cta_banner']->image)) : '' }}') center/cover no-repeat;">
    <div class="container py-5">
        <h2 class="display-5 fw-bold mb-3 font-heading text-white">{{ $sections['cta_banner']->title }}</h2>
        <p class="lead max-w-700 mx-auto text-light opacity-90 mb-4">{{ $sections['cta_banner']->subtitle }}</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('contact') }}" class="btn btn-brand-accent btn-lg px-5 shadow-lg">
                <i class="fas fa-envelope me-2"></i>Contact Expedition Team
            </a>
            <a href="{{ route('packages.index') }}" class="btn btn-outline-light btn-lg px-4">
                Explore All Treks
            </a>
        </div>
    </div>
</section>
@endif

@endsection
