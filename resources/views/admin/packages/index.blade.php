@extends('admin.layouts.app')

@section('title', 'Tour & Trek Packages')
@section('page-title', 'Tour & Trek Packages')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
    <div>
        <p class="text-muted mb-0">Create, edit, and manage all adventure tours, treks, and mountaineering packages.</p>
    </div>
    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Create New Package
    </a>
</div>

<!-- Filters -->
<div class="content-card mb-4">
    <div class="card-body py-3">
        <form action="{{ route('admin.packages.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Search package title, location..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-dark"><i class="fas fa-filter me-1"></i>Filter</button>
                @if(request()->hasAny(['search', 'category_id']))
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">Image</th>
                        <th>Package Title</th>
                        <th>Category</th>
                        <th>Duration / Alt</th>
                        <th>Price</th>
                        <th>Difficulty</th>
                        <th>Badges</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $pkg)
                    <tr>
                        <td>
                            @if($pkg->featured_image)
                                <img src="{{ Str::startsWith($pkg->featured_image, 'http') ? $pkg->featured_image : asset('uploads/' . $pkg->featured_image) }}" alt="{{ $pkg->title }}" class="rounded shadow-sm object-fit-cover" style="width: 55px; height: 45px;">
                            @else
                                <div class="bg-secondary-subtle rounded d-flex align-items-center justify-content-center text-muted" style="width: 55px; height: 45px;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $pkg->title }}</div>
                            <small class="text-muted"><i class="fas fa-map-marker-alt text-danger me-1"></i>{{ $pkg->location ?: $pkg->starting_point }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $pkg->category->name ?? 'Uncategorized' }}</span>
                        </td>
                        <td>
                            <div class="small fw-semibold">{{ $pkg->duration_days ? $pkg->duration_days . ' Days' : 'N/A' }}</div>
                            <small class="text-muted">{{ $pkg->max_altitude ?: '' }}</small>
                        </td>
                        <td>
                            <span class="fw-bold text-success">${{ number_format($pkg->price, 0) }}</span>
                            @if($pkg->price_note)<div class="small text-muted" style="font-size: 0.75rem;">{{ $pkg->price_note }}</div>@endif
                        </td>
                        <td>
                            @php
                                $diffColors = [
                                    'easy' => 'bg-success-subtle text-success',
                                    'moderate' => 'bg-info-subtle text-info',
                                    'difficult' => 'bg-warning-subtle text-warning',
                                    'extreme' => 'bg-danger-subtle text-danger',
                                ];
                            @endphp
                            <span class="badge {{ $diffColors[$pkg->difficulty_level] ?? 'bg-secondary-subtle text-secondary' }} text-capitalize">
                                {{ $pkg->difficulty_level ?? 'Normal' }}
                            </span>
                        </td>
                        <td>
                            @if($pkg->is_featured)
                                <span class="badge bg-warning text-dark me-1"><i class="fas fa-star me-1"></i>Featured</span>
                            @endif
                            @if($pkg->is_fixed_departure)
                                <span class="badge bg-primary me-1"><i class="fas fa-calendar-check me-1"></i>Fixed</span>
                            @endif
                        </td>
                        <td>
                            @if($pkg->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('packages.show', $pkg) }}" target="_blank" class="btn btn-sm btn-outline-info me-1" title="View on Site">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <a href="{{ route('admin.packages.edit', $pkg) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.packages.destroy', $pkg) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this package and all associated itineraries and gallery images?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="fas fa-suitcase-rolling fa-3x mb-3 d-block text-secondary"></i>
                            No tour packages found matching your criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($packages->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $packages->links() }}
    </div>
    @endif
</div>
@endsection
