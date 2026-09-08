@extends('admin.layouts.app')

@section('title', 'Inquiries')
@section('page-title', 'Customer Inquiries & Bookings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Manage customer tour requests, booking leads, and contact messages.</p>
</div>

<!-- Status Filters -->
<div class="mb-4">
    <div class="btn-group">
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-dark' : 'btn-outline-dark' }}">All</a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'new']) }}" class="btn btn-sm {{ request('status') == 'new' ? 'btn-primary' : 'btn-outline-primary' }}">New / Unread</a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'contacted']) }}" class="btn btn-sm {{ request('status') == 'contacted' ? 'btn-info' : 'btn-outline-info' }}">Contacted</a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'in_progress']) }}" class="btn btn-sm {{ request('status') == 'in_progress' ? 'btn-warning' : 'btn-outline-warning' }}">In Progress</a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'completed']) }}" class="btn btn-sm {{ request('status') == 'completed' ? 'btn-success' : 'btn-outline-success' }}">Completed</a>
    </div>
</div>

<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Client Info</th>
                        <th>Type / Package</th>
                        <th>Message Preview</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                    <tr class="{{ $inquiry->status == 'new' ? 'table-warning-subtle fw-semibold' : '' }}">
                        <td class="text-muted small">
                            {{ $inquiry->created_at->format('M d, Y') }}<br>
                            <span class="text-secondary" style="font-size: 0.75rem;">{{ $inquiry->created_at->format('H:i') }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $inquiry->name }}</div>
                            <small class="text-muted">{{ $inquiry->email }}</small>
                            @if($inquiry->phone)<div class="small text-muted">{{ $inquiry->phone }}</div>@endif
                        </td>
                        <td>
                            @if($inquiry->package)
                                <a href="{{ route('packages.show', $inquiry->package) }}" target="_blank" class="badge bg-primary text-decoration-none">
                                    <i class="fas fa-suitcase me-1"></i>{{ Str::limit($inquiry->package->title, 25) }}
                                </a>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">General Contact</span>
                            @endif
                            @if($inquiry->travelers_count)
                                <div class="small text-muted mt-1"><i class="fas fa-users me-1"></i>{{ $inquiry->travelers_count }} Travelers</div>
                            @endif
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 250px;">{{ $inquiry->message }}</div>
                        </td>
                        <td>
                            @php
                                $statusBadges = [
                                    'new' => 'bg-danger text-white',
                                    'contacted' => 'bg-info text-white',
                                    'in_progress' => 'bg-warning text-dark',
                                    'completed' => 'bg-success text-white',
                                    'cancelled' => 'bg-secondary text-white',
                                ];
                            @endphp
                            <span class="badge {{ $statusBadges[$inquiry->status] ?? 'bg-secondary' }} text-capitalize">
                                {{ str_replace('_', ' ', $inquiry->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-primary me-1">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this inquiry record?')">
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
                            <i class="fas fa-inbox fa-3x mb-3 d-block text-secondary"></i>
                            No inquiries found matching this filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($inquiries->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $inquiries->links() }}
    </div>
    @endif
</div>
@endsection
