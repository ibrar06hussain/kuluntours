@extends('admin.layouts.app')

@section('title', 'Add Testimonial')
@section('page-title', 'Add Client Review')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Review Details</span>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Client Name <span class="text-danger">*</span></label>
                            <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Country / Origin</label>
                            <input type="text" name="company" class="form-control" value="{{ old('company') }}" placeholder="e.g. Germany, UK, USA">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tour / Trek Name</label>
                            <input type="text" name="designation" class="form-control" value="{{ old('designation') }}" placeholder="e.g. K2 Base Camp Trek">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Star Rating</label>
                            <select name="rating" class="form-select">
                                <option value="5">★★★★★ (5 Stars)</option>
                                <option value="4">★★★★☆ (4 Stars)</option>
                                <option value="3">★★★☆☆ (3 Stars)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Review Text <span class="text-danger">*</span></label>
                        <textarea name="content" rows="4" class="form-control" placeholder="What did the client say about their expedition experience?" required>{{ old('content') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Client Photo (optional)</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="isActive">Display on Website</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>Save Testimonial
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
