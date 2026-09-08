<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Kunlun Treks Admin Panel</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Summernote Lite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 270px;
            --topbar-height: 65px;
            --primary: #8A0B14;
            --primary-dark: #111418;
            --brand-red: #D91A2A;
            --accent: #DFAB35;
            --accent-hover: #B8860B;
            --bg-body: #F8FAFC;
            --text-muted-light: #64748B;
        }

        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background: var(--bg-body);
            overflow-x: hidden;
            color: #2D3748;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 100%);
            z-index: 1040;
            transition: transform 0.3s ease;
            overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .admin-sidebar .brand {
            padding: 22px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            background: rgba(0,0,0,0.2);
        }

        .admin-sidebar .brand h4 {
            color: #fff;
            font-weight: 800;
            font-size: 1.15rem;
            letter-spacing: -0.5px;
            margin: 0;
        }

        .admin-sidebar .brand small {
            color: var(--accent);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
        }

        .sidebar-menu {
            list-style: none;
            padding: 16px 0;
            margin: 0;
        }

        .sidebar-menu .menu-header {
            padding: 14px 24px 6px;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.8px;
            color: rgba(255,255,255,0.4);
            font-weight: 700;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 11px 24px;
            color: rgba(255,255,255,0.72);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background: rgba(255,255,255,0.08);
            color: #fff;
            border-left-color: var(--accent);
        }

        .sidebar-menu li a i {
            width: 22px;
            margin-right: 12px;
            font-size: 0.95rem;
            text-align: center;
        }

        /* ===== MAIN CONTENT ===== */
        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== TOPBAR ===== */
        .admin-topbar {
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .admin-topbar .page-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1A202C;
            margin: 0;
        }

        .admin-content {
            padding: 28px;
            flex: 1;
        }

        /* ===== CONTENT CARDS ===== */
        .content-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            overflow: hidden;
        }

        .content-card .card-header {
            background: #fff;
            border-bottom: 1px solid #E2E8F0;
            padding: 18px 24px;
            font-weight: 700;
            font-size: 1rem;
            color: #1A202C;
        }

        .content-card .card-body { padding: 24px; }

        /* ===== BUTTONS & BADGES ===== */
        .btn-accent {
            background: var(--accent);
            color: #0F2D3F;
            border: none;
            font-weight: 600;
        }

        .btn-accent:hover {
            background: var(--accent-hover);
            color: #0F2D3F;
        }

        .btn-primary {
            background: #1B4965;
            border-color: #1B4965;
        }

        .btn-primary:hover {
            background: #0F2D3F;
            border-color: #0F2D3F;
        }

        .table th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #718096;
            font-weight: 700;
            border-bottom: 2px solid #E2E8F0;
            padding: 12px 16px;
        }

        .table td {
            padding: 14px 16px;
            vertical-align: middle;
            font-size: 0.875rem;
        }

        /* ===== RESPONSIVE ===== */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #1F2937;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1035;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    @include('admin.layouts.partials.sidebar')

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Topbar -->
        @include('admin.layouts.partials.topbar')

        <!-- Page Content -->
        <div class="admin-content">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2 fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2 fs-5"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <div class="fw-bold mb-1"><i class="fas fa-exclamation-triangle me-2"></i>Please correct the following errors:</div>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Summernote Lite JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        // Sidebar toggle for mobile
        const sidebar = document.querySelector('.admin-sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        }

        // CSRF token for AJAX
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        // Initialize Summernote WYSIWYG editor
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250,
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        uploadEditorImage(files[0], $(this));
                    }
                }
            });
        });

        function uploadEditorImage(file, editor) {
            let data = new FormData();
            data.append("image", file);
            $.ajax({
                url: '{{ route("admin.media.editor.upload") }}',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "post",
                success: function(response) {
                    if (response.url) {
                        editor.summernote('insertImage', response.url);
                    }
                },
                error: function(err) {
                    console.error("Image upload failed", err);
                    alert("Failed to upload image.");
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
