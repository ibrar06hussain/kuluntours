@extends('admin.layouts.app')

@section('title', 'Inquiry Details')
@section('page-title', 'Inquiry Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="content-card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Message Content</span>
                <span class="text-muted small">{{ $inquiry->created_at->format('F d, Y - h:i A') }}</span>
            </div>
            <div class="card-body">
                @if($inquiry->subject)
                    <div class="mb-3">
                        <label class="text-muted small text-uppercase fw-bold">Subject</label>
                        <h5 class="fw-bold text-dark">{{ $inquiry->subject }}</h5>
                    </div>
                @endif

                @if($inquiry->package)
                    <div class="alert alert-primary d-flex align-items-center mb-4">
                        <i class="fas fa-mountain fa-2x me-3 text-primary"></i>
                        <div>
                            <div class="fw-bold fs-6">Interested Package: {{ $inquiry->package->title }}</div>
                            <div class="small text-muted">{{ $inquiry->package->duration_days }} Days • Price: PKR {{ number_format($inquiry->package->price, 0) }}</div>
                        </div>
                        <a href="{{ route('packages.show', $inquiry->package) }}" target="_blank" class="btn btn-sm btn-primary ms-auto">
                            View Package
                        </a>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-bold">Client Message</label>
                    <div class="p-3 bg-light rounded border text-dark lead fs-6 lh-base">
                        {{ $inquiry->message }}
                    </div>
                </div>

                <div class="row g-3">
                    @if($inquiry->travelers_count)
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase fw-bold">Number of Travelers</label>
                            <div class="fw-bold">{{ $inquiry->travelers_count }} Persons</div>
                        </div>
                    @endif
                    @if($inquiry->preferred_date)
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase fw-bold">Preferred Start Date</label>
                            <div class="fw-bold">{{ \Carbon\Carbon::parse($inquiry->preferred_date)->format('M d, Y') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Client Details -->
        <div class="content-card mb-4">
            <div class="card-header">Client Profile</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small text-uppercase fw-bold">Full Name</label>
                    <div class="fw-bold text-dark fs-6">{{ $inquiry->name }}</div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small text-uppercase fw-bold">Email Address</label>
                    <div><a href="mailto:{{ $inquiry->email }}" class="text-primary fw-semibold">{{ $inquiry->email }}</a></div>
                </div>
                @if($inquiry->phone)
                    <div class="mb-3">
                        <label class="text-muted small text-uppercase fw-bold">Phone Number</label>
                        <div><a href="tel:{{ $inquiry->phone }}" class="text-dark">{{ $inquiry->phone }}</a></div>
                    </div>
                @endif
                @if($inquiry->country)
                    <div class="mb-0">
                        <label class="text-muted small text-uppercase fw-bold">Country / Location</label>
                        <div>{{ $inquiry->country }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Status & Internal Notes -->
        <div class="content-card mb-4">
            <div class="card-header">Workflow Status & Notes</div>
            <div class="card-body">
                <form action="{{ route('admin.inquiries.status', $inquiry) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select">
                            <option value="new" {{ $inquiry->status == 'new' ? 'selected' : '' }}>New / Unread</option>
                            <option value="contacted" {{ $inquiry->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                            <option value="in_progress" {{ $inquiry->status == 'in_progress' ? 'selected' : '' }}>In Progress (Quotation Sent)</option>
                            <option value="completed" {{ $inquiry->status == 'completed' ? 'selected' : '' }}>Completed (Confirmed Booking)</option>
                            <option value="cancelled" {{ $inquiry->status == 'cancelled' ? 'selected' : '' }}>Cancelled / Lost</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Internal Admin Notes</label>
                        <textarea name="admin_notes" rows="3" class="form-control" placeholder="Add follow-up notes or quote details...">{{ $inquiry->admin_notes }}</textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
