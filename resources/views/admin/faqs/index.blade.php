@extends('admin.layouts.app')

@section('title', 'FAQs')
@section('page-title', 'Frequently Asked Questions')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Manage questions and answers regarding permits, visas, safety, meals, and fitness.</p>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New FAQ
    </a>
</div>

<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">Order</th>
                        <th>Question</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                    <tr>
                        <td class="fw-bold text-muted">{{ $faq->sort_order }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $faq->question }}</div>
                            <small class="text-muted">{{ Str::limit(strip_tags($faq->answer), 85) }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-primary border">{{ $faq->category ?: 'General' }}</span>
                        </td>
                        <td>
                            @if($faq->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Hidden</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this FAQ?')">
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
                            <i class="fas fa-question-circle fa-3x mb-3 d-block text-secondary"></i>
                            No FAQs created yet. Click "Add New FAQ" to create one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
