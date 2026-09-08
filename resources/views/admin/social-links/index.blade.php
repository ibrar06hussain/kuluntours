@extends('admin.layouts.app')

@section('title', 'Social Links')
@section('page-title', 'Social Media Channels')

@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="content-card mb-4">
            <div class="card-header"><i class="fas fa-plus-circle me-2"></i>Add Social Platform</div>
            <div class="card-body">
                <form action="{{ route('admin.social-links.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Platform Name <span class="text-danger">*</span></label>
                        <input type="text" name="platform" class="form-control" placeholder="e.g. Facebook, Instagram, YouTube, TripAdvisor" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Profile URL <span class="text-danger">*</span></label>
                        <input type="url" name="url" class="form-control" placeholder="https://..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Font Awesome Icon Class <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-icons"></i></span>
                            <input type="text" name="icon_class" class="form-control" placeholder="e.g. fab fa-facebook-f, fab fa-instagram" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="0">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" checked>
                                <label class="form-check-label fw-bold" for="isActive">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Add Social Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="content-card">
            <div class="card-header">Active Social Channels</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Platform</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($links as $link)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded p-2 me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <i class="{{ $link->icon_class }}"></i>
                                        </div>
                                        <div class="fw-bold">{{ $link->platform }}</div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ $link->url }}" target="_blank" class="small text-truncate d-inline-block text-primary" style="max-width: 200px;">{{ $link->url }}</a>
                                </td>
                                <td>
                                    @if($link->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Disabled</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this social link?')">
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
                                <td colspan="4" class="text-center py-4 text-muted">No social links configured.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
