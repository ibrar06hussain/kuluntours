@extends('admin.layouts.app')

@section('title', 'Add Team Member')
@section('page-title', 'Add Team Member')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Member Details</span>
                <a href="{{ route('admin.team-members.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.team-members.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Designation / Role <span class="text-danger">*</span></label>
                            <input type="text" name="designation" class="form-control" value="{{ old('designation') }}" placeholder="e.g. Lead Mountain Guide, Medical Officer" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Short Bio</label>
                        <textarea name="bio" rows="3" class="form-control" placeholder="Climbing background, summits, experience...">{{ old('bio') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Profile Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Facebook URL</label>
                            <input type="url" name="facebook" class="form-control" value="{{ old('facebook') }}" placeholder="https://...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Instagram URL</label>
                            <input type="url" name="instagram" class="form-control" value="{{ old('instagram') }}" placeholder="https://...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">LinkedIn URL</label>
                            <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin') }}" placeholder="https://...">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="isActive">Display on About Us Page</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.team-members.index') }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>Save Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
