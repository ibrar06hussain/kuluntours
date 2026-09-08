@extends('admin.layouts.app')

@section('title', 'Categories')
@section('page-title', 'Tour & Trek Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Manage tour types, trekking tiers, and expedition categories.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Category
    </a>
</div>

<div class="content-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">Order</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Packages</th>
                        <th>Menu</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="text-muted fw-bold">{{ $category->sort_order }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-2 text-primary me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="{{ $category->icon_class ?: 'fas fa-mountain' }} fs-5"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $category->name }}</div>
                                    <small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                                </div>
                            </div>
                        </td>
                        <td><code>{{ $category->slug }}</code></td>
                        <td>
                            <span class="badge bg-primary-subtle text-primary fw-semibold px-2 py-1">
                                {{ $category->packages_count }} {{ Str::plural('package', $category->packages_count) }}
                            </span>
                        </td>
                        <td>
                            @if($category->show_in_menu)
                                <span class="badge bg-success-subtle text-success">Visible</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Hidden</span>
                            @endif
                        </td>
                        <td>
                            @if($category->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this category? All related packages will be affected.')">
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
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x mb-3 d-block text-secondary"></i>
                            No categories found. Click "Add New Category" to create one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($categories->hasPages())
    <div class="card-footer bg-white border-top py-3">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection
