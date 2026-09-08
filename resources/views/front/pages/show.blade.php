@extends('front.layouts.app')

@section('title', ($page->meta_title ?: $page->title) . ' - Kunlun Treks and Tours')
@section('meta_description', $page->meta_description ?: Str::limit(strip_tags($page->content), 160))

@section('content')
<!-- Page Header -->
<section class="py-5 bg-dark text-white position-relative" style="background: linear-gradient(180deg, #07151F 0%, #0C2333 100%);">
    <div class="container py-4 text-center">
        <span class="section-tag">Kunlun Treks & Tours</span>
        <h1 class="display-4 fw-bold font-heading text-white mb-2">{{ $page->title }}</h1>
    </div>
</section>

<!-- Content Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                @if($page->featured_image)
                    <div class="mb-5">
                        <img src="{{ Str::startsWith($page->featured_image, 'http') ? $page->featured_image : asset('uploads/' . $page->featured_image) }}" class="rounded-4 img-fluid w-100 shadow-sm" alt="{{ $page->title }}">
                    </div>
                @endif

                <div class="cms-content lead fs-6 lh-lg text-secondary mb-5">
                    {!! $page->content !!}
                </div>

                <!-- If About Us Page, Display Team Members -->
                @if($page->slug === 'about-us' && isset($teamMembers) && count($teamMembers) > 0)
                    <div class="mt-5 pt-5 border-top">
                        <div class="section-header text-center mb-5">
                            <span class="section-tag">Meet the Legends</span>
                            <h2 class="section-title">Our Mountain Expedition Leaders</h2>
                            <p class="text-muted max-w-700 mx-auto">Native high-altitude climbers and wilderness specialists with decades of experience on 8000m giants.</p>
                        </div>

                        <div class="row g-4">
                            @foreach($teamMembers as $member)
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 bg-white">
                                        @if($member->photo)
                                            <img src="{{ Str::startsWith($member->photo, 'http') ? $member->photo : asset('uploads/' . $member->photo) }}" class="rounded-circle mx-auto mb-3 object-fit-cover shadow-sm" style="width: 110px; height: 110px;" alt="{{ $member->name }}">
                                        @else
                                            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3 fs-3 fw-bold" style="width: 110px; height: 110px;">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <h5 class="fw-bold mb-1">{{ $member->name }}</h5>
                                        <p class="text-warning small fw-bold mb-2">{{ $member->designation }}</p>
                                        <p class="text-muted small mb-0">{{ $member->bio }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
