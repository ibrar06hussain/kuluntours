<div class="admin-topbar">
    <div class="d-flex align-items-center">
        <button class="sidebar-toggle me-3" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <h5 class="page-title">@yield('page-title', 'Dashboard')</h5>
    </div>

    <div class="d-flex align-items-center">
        <a href="{{ url('/') }}" class="btn btn-sm btn-outline-secondary me-3" target="_blank">
            <i class="fas fa-external-link-alt me-1"></i> View Site
        </a>

        <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name ?? 'Admin' }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
