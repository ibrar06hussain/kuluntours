@extends('admin.layouts.app')

@section('title', 'Homepage Sections')
@section('page-title', 'Homepage Content Sections')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Edit dynamic homepage introductory sections, "Why Choose Us", and Call-to-Action banners.</p>
</div>

<div class="row g-4">
    @foreach($sections as $section)
        <div class="col-md-4">
            <div class="content-card h-100 d-flex flex-column">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="badge bg-primary-subtle text-primary">{{ $section->section_key }}</span>
                    @if($section->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Disabled</span>
                    @endif
                </div>
                <div class="card-body flex-grow-1">
                    @if($section->image)
                        <div class="mb-3">
                            <img src="{{ Str::startsWith($section->image, 'http') ? $section->image : asset('uploads/' . $section->image) }}" class="rounded img-fluid w-100 object-fit-cover" style="height: 140px;">
                        </div>
                    @endif
                    <h5 class="fw-bold mb-1">{{ $section->title }}</h5>
                    <p class="text-muted small mb-3">{{ $section->subtitle }}</p>
                    <div class="text-secondary small">
                        {!! Str::limit(strip_tags($section->description), 120) !!}
                    </div>
                </div>
                <div class="card-footer bg-white border-top p-3 text-end">
                    <a href="{{ route('admin.homepage-sections.edit', $section) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit Section
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
