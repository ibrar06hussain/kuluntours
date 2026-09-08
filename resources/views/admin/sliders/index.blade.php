@extends('admin.layouts.app')

@section('title', 'Hero Sliders')
@section('page-title', 'Homepage Hero Sliders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Manage the hero slides, titles, subtitles, and call-to-action buttons on the homepage banner.</p>
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Slide
    </a>
</div>

<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">Order</th>
                        <th style="width: 120px;">Image</th>
                        <th>Title & Subtitle</th>
                        <th>CTA Button</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sliders as $slider)
                    <tr>
                        <td class="fw-bold text-muted">{{ $slider->sort_order }}</td>
                        <td>
                            <img src="{{ Str::startsWith($slider->image, 'http') ? $slider->image : asset('uploads/' . $slider->image) }}" alt="{{ $slider->title }}" class="rounded shadow-sm object-fit-cover" style="width: 100px; height: 55px;">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $slider->title ?: 'No Title' }}</div>
                            <small class="text-muted">{{ Str::limit($slider->subtitle, 65) }}</small>
                        </td>
                        <td>
                            @if($slider->button_text)
                                <span class="badge bg-warning text-dark"><i class="fas fa-link me-1"></i>{{ $slider->button_text }}</span>
                            @else
                                <span class="text-muted small">None</span>
                            @endif
                        </td>
                        <td>
                            @if($slider->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this slide?')">
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
                            <i class="fas fa-images fa-3x mb-3 d-block text-secondary"></i>
                            No slides configured yet. Click "Add New Slide" to create one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
