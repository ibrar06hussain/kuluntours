@extends('admin.layouts.app')

@section('title', 'CMS Pages')
@section('page-title', 'CMS Content Pages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Manage information pages like About Us, Visa Information, Booking Policies, Terms & Privacy.</p>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Create New Page
    </a>
</div>

<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Page Title</th>
                        <th>URL Slug</th>
                        <th>Status</th>
                        <th>Last Modified</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $page->title }}</div>
                            <small class="text-muted">{{ Str::limit(strip_tags($page->content), 60) }}</small>
                        </td>
                        <td><code>/page/{{ $page->slug }}</code></td>
                        <td>
                            @if($page->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $page->updated_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('pages.show', $page) }}" target="_blank" class="btn btn-sm btn-outline-info me-1">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this page?')">
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
                            <i class="fas fa-file-alt fa-3x mb-3 d-block text-secondary"></i>
                            No pages found. Click "Create New Page" to add one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
