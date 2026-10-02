@extends('front.layouts.app')

@section('title', ($currentCategory ? $currentCategory->name : 'Adventures & Treks') . ' - Kunlun Treks and Tours')
@section('meta_description', $currentCategory ? $currentCategory->meta_description : 'Browse all guided treks, mountaineering expeditions, rock climbing, and cultural tours in Pakistan.')

@section('content')
<!-- Page Header Banner -->
<section class="py-5 text-white position-relative" style="background: linear-gradient(135deg, #111418 0%, #1A1E24 60%, #8A0B14 100%); border-bottom: 3px solid var(--brand-gold);">
    <div class="container py-4 text-center">
        <span class="section-tag" style="color: var(--brand-gold-light);">{{ $currentCategory ? 'Category Archive' : 'Expedition Catalog' }}</span>
        <h1 class="display-4 fw-bold font-heading text-white mb-2">
            {{ $currentCategory ? $currentCategory->name : 'All Treks & Expeditions' }}
        </h1>
        <p class="text-light opacity-75 max-w-700 mx-auto">
            {{ $currentCategory ? $currentCategory->description : 'Explore Pakistan\'s greatest wilderness trails across the Karakoram, Himalayas, and Hindukush mountain systems.' }}
        </p>
    </div>
</section>

<!-- Category Tabs -->
<div class="bg-white border-bottom shadow-sm">
    <div class="container">
        <div class="d-flex overflow-auto py-3 gap-2 text-nowrap">
            <a href="{{ route('packages.index') }}" class="btn btn-sm {{ !$currentCategory ? 'btn-brand-primary' : 'btn-outline-secondary' }} rounded-pill px-3">
                All Trips
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('packages.category', $cat) }}" class="btn btn-sm {{ ($currentCategory && $currentCategory->id == $cat->id) ? 'btn-brand-primary' : 'btn-outline-secondary' }} rounded-pill px-3">
                    <i class="{{ $cat->icon_class ?: 'fas fa-mountain' }} me-1"></i>{{ $cat->name }} ({{ $cat->active_packages_count ?? $cat->packages_count ?? 0 }})
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Main Listing Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <div class="card border rounded-4 p-4 shadow-sm sticky-top" style="top: 90px;">
                    <h5 class="fw-bold mb-3 font-heading"><i class="fas fa-sliders-h text-warning me-2"></i>Filter Trips</h5>
                    <form action="{{ route('packages.index') }}" method="GET">
                        @if($currentCategory)
                            <input type="hidden" name="category" value="{{ $currentCategory->slug }}">
                        @endif

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Search Keyword</label>
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="e.g. K2, Concordia" value="{{ request('search') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Difficulty Level</label>
                            <select name="difficulty" class="form-select form-select-sm">
                                <option value="">All Difficulties</option>
                                <option value="easy" {{ request('difficulty') == 'easy' ? 'selected' : '' }}>Easy (Leisure)</option>
                                <option value="moderate" {{ request('difficulty') == 'moderate' ? 'selected' : '' }}>Moderate (Trekking)</option>
                                <option value="difficult" {{ request('difficulty') == 'difficult' ? 'selected' : '' }}>Difficult (Glaciers)</option>
                                <option value="extreme" {{ request('difficulty') == 'extreme' ? 'selected' : '' }}>Extreme (Climbing)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Duration Range</label>
                            <select name="duration" class="form-select form-select-sm">
                                <option value="">Any Duration</option>
                                <option value="1-7" {{ request('duration') == '1-7' ? 'selected' : '' }}>1 - 7 Days (Short)</option>
                                <option value="8-14" {{ request('duration') == '8-14' ? 'selected' : '' }}>8 - 14 Days (Medium)</option>
                                <option value="15-21" {{ request('duration') == '15-21' ? 'selected' : '' }}>15 - 21 Days (Standard Baltoro)</option>
                                <option value="22+" {{ request('duration') == '22+' ? 'selected' : '' }}>22+ Days (Expeditions)</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-brand-primary btn-sm">Apply Filters</button>
                            @if(request()->hasAny(['search', 'difficulty', 'duration']))
                                <a href="{{ $currentCategory ? route('packages.category', $currentCategory) : route('packages.index') }}" class="btn btn-outline-secondary btn-sm">Reset Filters</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Packages Grid -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="text-muted small">Showing <strong>{{ $packages->total() }}</strong> adventures found</span>
                </div>

                <div class="row g-4">
                    @forelse($packages as $pkg)
                        <div class="col-md-6">
                            <div class="package-card">
                                <div class="package-card-img-wrapper">
                                    <img src="{{ Str::startsWith($pkg->featured_image, 'http') ? $pkg->featured_image : asset('uploads/' . $pkg->featured_image) }}" alt="{{ $pkg->title }}">
                                    <span class="package-badge-category">{{ $pkg->category->name ?? 'Adventure' }}</span>
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
                                        <span class="text-muted small"><i class="fas fa-map-marker-alt text-danger me-1"></i>{{ Str::limit($pkg->location ?: $pkg->starting_point, 16) }}</span>
                                        <a href="{{ route('packages.show', $pkg) }}" class="btn btn-sm btn-brand-primary">
                                            View Details <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-compass fa-3x text-secondary mb-3 d-block"></i>
                            <h4>No adventures found</h4>
                            <p class="text-muted">Try adjusting your filters or search criteria.</p>
                            <a href="{{ route('packages.index') }}" class="btn btn-outline-dark">Browse All Packages</a>
                        </div>
                    @endforelse
                </div>

                @if($packages->hasPages())
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $packages->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
