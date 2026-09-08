@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Total Packages</div>
                    <div class="stat-value">{{ $stats['packages'] }}</div>
                </div>
                <div class="stat-icon" style="background: rgba(27,73,101,0.1); color: var(--primary);">
                    <i class="fas fa-suitcase-rolling"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Categories</div>
                    <div class="stat-value">{{ $stats['categories'] }}</div>
                </div>
                <div class="stat-icon" style="background: rgba(232,163,23,0.1); color: var(--accent);">
                    <i class="fas fa-folder"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Unread Inquiries</div>
                    <div class="stat-value">{{ $stats['unread_inquiries'] }}</div>
                </div>
                <div class="stat-icon" style="background: rgba(220,53,69,0.1); color: #DC3545;">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stat-label">Testimonials</div>
                    <div class="stat-value">{{ $stats['testimonials'] }}</div>
                </div>
                <div class="stat-icon" style="background: rgba(25,135,84,0.1); color: #198754;">
                    <i class="fas fa-quote-right"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-envelope me-2"></i>Recent Inquiries</span>
                <a href="#" class="btn btn-sm btn-accent">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="padding-left:24px">Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentInquiries as $inquiry)
                                <tr>
                                    <td style="padding-left:24px">
                                        <strong>{{ $inquiry->name }}</strong>
                                    </td>
                                    <td>{{ $inquiry->email }}</td>
                                    <td>{{ Str::limit($inquiry->subject, 30) }}</td>
                                    <td>{{ $inquiry->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($inquiry->is_read)
                                            <span class="badge bg-success">Read</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Unread</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        No inquiries yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="content-card">
            <div class="card-header">
                <i class="fas fa-chart-pie me-2"></i>Quick Stats
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-muted"><i class="fas fa-blog me-2"></i>Blog Posts</span>
                        <strong>{{ $stats['blog_posts'] }}</strong>
                    </li>
                    <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-muted"><i class="fas fa-envelope me-2"></i>Total Inquiries</span>
                        <strong>{{ $stats['inquiries'] }}</strong>
                    </li>
                    <li class="d-flex justify-content-between align-items-center py-2">
                        <span class="text-muted"><i class="fas fa-suitcase me-2"></i>Packages</span>
                        <strong>{{ $stats['packages'] }}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
