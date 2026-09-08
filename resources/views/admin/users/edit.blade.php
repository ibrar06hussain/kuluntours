@extends('admin.layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User Account')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Edit User: <strong>{{ $user->name }}</strong></span>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-select" required>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator (Full Access)</option>
                            <option value="editor" {{ old('role', $user->role) == 'editor' ? 'selected' : '' }}>Editor (Content & Tours)</option>
                            <option value="author" {{ old('role', $user->role) == 'author' ? 'selected' : '' }}>Author (Blog Only)</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">New Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Leave blank to keep current">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Avatar Photo</label>
                        @if($user->avatar)
                            <div class="mb-2">
                                <img src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('uploads/' . $user->avatar) }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="avatar" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep existing avatar.</small>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
