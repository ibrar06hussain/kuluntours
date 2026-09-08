@extends('admin.layouts.app')

@section('title', 'Team Members')
@section('page-title', 'Expedition Leaders & Team')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Manage mountain guides, expedition leads, and support specialists displayed on the About page.</p>
    <a href="{{ route('admin.team-members.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Team Member
    </a>
</div>

<div class="row g-4">
    @forelse($members as $member)
        <div class="col-md-4">
            <div class="content-card h-100 d-flex flex-column">
                <div class="card-body text-center flex-grow-1">
                    @if($member->photo)
                        <img src="{{ Str::startsWith($member->photo, 'http') ? $member->photo : asset('uploads/' . $member->photo) }}" class="rounded-circle mb-3 object-fit-cover shadow-sm" style="width: 100px; height: 100px;">
                    @else
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3 fs-3 fw-bold" style="width: 100px; height: 100px;">
                            {{ substr($member->name, 0, 1) }}
                        </div>
                    @endif
                    <h5 class="fw-bold mb-1">{{ $member->name }}</h5>
                    <p class="text-primary small fw-semibold mb-2">{{ $member->designation }}</p>
                    <p class="text-muted small mb-3">{{ Str::limit($member->bio, 90) }}</p>

                    <div class="d-flex justify-content-center gap-2 text-muted">
                        @if($member->facebook)<a href="{{ $member->facebook }}" target="_blank" class="text-secondary"><i class="fab fa-facebook"></i></a>@endif
                        @if($member->instagram)<a href="{{ $member->instagram }}" target="_blank" class="text-secondary"><i class="fab fa-instagram"></i></a>@endif
                        @if($member->linkedin)<a href="{{ $member->linkedin }}" target="_blank" class="text-secondary"><i class="fab fa-linkedin"></i></a>@endif
                    </div>
                </div>
                <div class="card-footer bg-white border-top p-3 d-flex justify-content-between align-items-center">
                    <span class="badge {{ $member->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $member->is_active ? 'Active' : 'Hidden' }}</span>
                    <div>
                        <a href="{{ route('admin.team-members.edit', $member) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this team member?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 text-muted">
            <i class="fas fa-users fa-3x mb-3 d-block text-secondary"></i>
            No team members added yet.
        </div>
    @endforelse
</div>
@endsection
