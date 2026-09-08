@extends('admin.layouts.app')

@section('title', 'Testimonials')
@section('page-title', 'Client Testimonials & Reviews')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Manage customer reviews and feedback displayed across the website.</p>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Testimonial
    </a>
</div>

<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Client</th>
                        <th>Review / Feedback</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($item->photo)
                                    <img src="{{ Str::startsWith($item->photo, 'http') ? $item->photo : asset('uploads/' . $item->photo) }}" class="rounded-circle me-3 object-fit-cover" style="width: 45px; height: 45px;">
                                @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 45px; height: 45px;">
                                        {{ substr($item->client_name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold">{{ $item->client_name }}</div>
                                    <small class="text-muted">{{ $item->designation ?: 'Traveler' }} {{ $item->company ? '• ' . $item->company : '' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 text-secondary small fst-italic">"{{ Str::limit($item->content, 100) }}"</p>
                        </td>
                        <td>
                            <div class="text-warning small">
                                @for($i = 0; $i < $item->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </td>
                        <td>
                            @if($item->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Hidden</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.testimonials.edit', $item) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this testimonial?')">
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
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-quote-right fa-3x mb-3 d-block text-secondary"></i>
                            No testimonials found. Click "Add Testimonial" to create one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
