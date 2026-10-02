<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $globalSettings['meta_title'] ?? 'Kunlun Treks and Tours - Premier Mountain Adventure Travel')</title>
    <meta name="description" content="@yield('meta_description', $globalSettings['meta_description'] ?? 'Explore the Karakoram, Himalayas, and Hindukush with Kunlun Treks and Tours. High-altitude trekking, peak expeditions, and cultural tours in Pakistan.')">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts: Outfit, Montserrat & Plus Jakarta Sans for welcoming, modern tourism & adventure aesthetic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            /* Kunlun Brand Theme (derived from official Red & Gold logo) */
            --brand-red: #D91A2A;
            --brand-red-dark: #B30D1B;
            --brand-red-deep: #8A0B14;
            --brand-red-subtle: #FFF1F2;
            
            --brand-gold: #DFAB35;
            --brand-gold-light: #F5C862;
            --brand-gold-dark: #B8860B;
            --brand-gold-gradient: linear-gradient(135deg, #F3A812 0%, #DFAB35 50%, #B8860B 100%);
            --brand-red-gradient: linear-gradient(135deg, #E61C24 0%, #C8102E 60%, #8A0B14 100%);
            
            --brand-dark: #111418;
            --brand-dark-surface: #1A1E24;
            --brand-light: #FAF9F6;
            --brand-gray: #64748B;
            --brand-border: #E2E8F0;
            
            --font-heading: 'Outfit', 'Montserrat', sans-serif;
            --font-brand: 'Montserrat', sans-serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            font-family: var(--font-body);
            color: #334155;
            background-color: #FFFFFF;
            overflow-x: hidden;
            line-height: 1.65;
        }

        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: var(--font-heading);
            color: var(--brand-dark);
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        /* Top Notification Bar */
        .top-bar {
            background: var(--brand-dark);
            color: #94A3B8;
            font-size: 0.8rem;
            padding: 7px 0;
            border-bottom: 2px solid var(--brand-gold);
        }

        .top-bar a {
            color: #CBD5E1;
            text-decoration: none;
            transition: color 0.2s;
        }

        .top-bar a:hover {
            color: var(--brand-gold);
        }

        /* Main Navbar */
        .navbar-main {
            background: #ffffff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            padding: 10px 0;
        }

        .navbar-main.scrolled {
            padding: 8px 0;
            box-shadow: 0 6px 25px rgba(217, 26, 42, 0.08);
            border-bottom: 1px solid rgba(223, 171, 53, 0.2);
        }

        .navbar-brand-logo {
            height: 52px;
            width: auto;
            object-fit: contain;
            transition: transform 0.2s;
        }

        .navbar-brand:hover .navbar-brand-logo {
            transform: scale(1.03);
        }

        .navbar-brand-text {
            font-family: var(--font-brand);
            font-weight: 800;
            font-size: 1.3rem;
            line-height: 1.1;
            color: var(--brand-red);
            letter-spacing: -0.5px;
        }

        .navbar-brand-text span {
            color: var(--brand-gold-dark);
        }

        .nav-link {
            font-weight: 600;
            color: var(--brand-dark) !important;
            font-size: 0.92rem;
            padding: 8px 16px !important;
            text-transform: capitalize;
            transition: all 0.2s;
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--brand-red) !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 16px;
            right: 16px;
            height: 2px;
            background: var(--brand-red);
            border-radius: 2px;
        }

        .dropdown-menu {
            border: 1px solid var(--brand-border);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
            border-radius: 12px;
            padding: 10px;
            min-width: 230px;
        }

        .dropdown-item {
            font-weight: 500;
            font-size: 0.88rem;
            padding: 9px 16px;
            border-radius: 8px;
            color: var(--brand-dark);
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background-color: var(--brand-red-subtle);
            color: var(--brand-red);
            transform: translateX(4px);
        }

        /* Buttons */
        .btn-brand-accent {
            background: var(--brand-gold-gradient);
            color: #111418;
            font-weight: 700;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(223, 171, 53, 0.3);
        }

        .btn-brand-accent:hover {
            background: linear-gradient(135deg, #DFAB35 0%, #B8860B 100%);
            color: #111418;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(223, 171, 53, 0.45);
        }

        .btn-brand-primary {
            background: var(--brand-red-gradient);
            color: #ffffff;
            font-weight: 600;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(217, 26, 42, 0.25);
        }

        .btn-brand-primary:hover {
            background: linear-gradient(135deg, #B30D1B 0%, #8A0B14 100%);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(217, 26, 42, 0.4);
        }

        .btn-outline-brand {
            border: 2px solid var(--brand-red);
            color: var(--brand-red);
            font-weight: 600;
            padding: 9px 22px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-outline-brand:hover {
            background-color: var(--brand-red);
            color: #ffffff;
        }

        /* Hero Carousel */
        .hero-slider .carousel-item {
            height: 82vh;
            min-height: 550px;
            position: relative;
        }

        .hero-slider .carousel-item img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            filter: brightness(0.65);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(17,20,24,0.35) 0%, rgba(17,20,24,0.8) 100%);
            display: flex;
            align-items: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.15;
            text-shadow: 0 2px 12px rgba(0,0,0,0.6);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #F8FAFC;
            font-weight: 400;
            margin-bottom: 2rem;
            text-shadow: 0 1px 6px rgba(0,0,0,0.6);
        }

        @media (max-width: 768px) {
            .hero-slider .carousel-item {
                height: 70vh;
            }
            .hero-title {
                font-size: 2.2rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
        }

        /* Package Cards */
        .package-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--brand-border);
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: all 0.35s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .package-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px rgba(217, 26, 42, 0.12);
            border-color: rgba(223, 171, 53, 0.4);
        }

        .package-card-img-wrapper {
            position: relative;
            height: 230px;
            overflow: hidden;
        }

        .package-card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .package-card:hover .package-card-img-wrapper img {
            transform: scale(1.08);
        }

        .package-badge-category {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(17, 20, 24, 0.85);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(223, 171, 53, 0.4);
            color: var(--brand-gold-light);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .package-badge-price {
            position: absolute;
            bottom: 14px;
            right: 14px;
            background: var(--brand-gold-gradient);
            color: #111418;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.4);
        }

        .package-card-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .package-meta-item {
            font-size: 0.8rem;
            color: var(--brand-gray);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .package-meta-item i {
            color: var(--brand-red);
        }

        /* Section Titles */
        .section-header {
            margin-bottom: 45px;
        }

        .section-tag {
            color: var(--brand-red);
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-size: 0.8rem;
            font-weight: 800;
            margin-bottom: 8px;
            display: inline-block;
        }

        .section-title {
            font-size: 2.35rem;
            font-weight: 800;
            color: var(--brand-dark);
        }

        /* Floating WhatsApp Button */
        .whatsapp-floating {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #25D366;
            color: #ffffff;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.45);
            z-index: 1000;
            transition: all 0.3s;
            text-decoration: none;
        }

        .whatsapp-floating:hover {
            transform: scale(1.1) rotate(5deg);
            color: #ffffff;
        }

        /* Footer */
        .site-footer {
            background-color: #1e2633;
            color: #d1d5db;
            padding-top: 70px;
            padding-bottom: 30px;
            border-top: 4px solid var(--brand-red);
            position: relative;
        }

        .site-footer::before {
            content: '';
            position: absolute;
            top: -7px;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--brand-gold-gradient);
        }

        .site-footer .text-muted {
            color: #d1d5db !important;
        }

        .footer-heading {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 24px;
            position: relative;
            padding-bottom: 12px;
        }

        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 35px;
            height: 3px;
            background: var(--brand-gold);
            border-radius: 2px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #e5e7eb;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.92rem;
        }

        .footer-links a:hover {
            color: var(--brand-gold);
            transform: translateX(4px);
        }

        .footer-bottom {
            margin-top: 50px;
            padding-top: 25px;
            border-top: 1px solid rgba(255,255,255,0.12);
            font-size: 0.88rem;
            color: #d1d5db;
        }

        .footer-bottom a {
            color: #e5e7eb !important;
            transition: color 0.2s;
        }

        .footer-bottom a:hover {
            color: var(--brand-gold) !important;
        }

        .site-footer .bg-dark {
            background-color: #161c26 !important;
            border-color: rgba(255,255,255,0.15) !important;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Top Contact Bar -->
    <div class="top-bar d-none d-md-block">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex gap-4">
                    <span><i class="fas fa-map-marker-alt text-warning me-1"></i> {{ $globalSettings['address'] ?? 'Skardu, Gilgit-Baltistan, Pakistan' }}</span>
                    <span><i class="fas fa-envelope text-warning me-1"></i> <a href="mailto:{{ $globalSettings['email'] ?? 'info@kunluntreks.com' }}">{{ $globalSettings['email'] ?? 'info@kunluntreks.com' }}</a></span>
                    @if(!empty($globalSettings['phone']))
                        <span><i class="fas fa-phone-alt text-warning me-1"></i> <a href="tel:{{ $globalSettings['phone'] }}">{{ $globalSettings['phone'] }}</a></span>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-3">
                    @foreach($globalSocialLinks as $social)
                        <a href="{{ $social->url }}" target="_blank" title="{{ $social->platform }}"><i class="{{ $social->icon_class }}"></i></a>
                    @endforeach
                    <a href="{{ route('contact') }}" class="badge bg-warning text-dark fw-bold text-decoration-none px-2 py-1 ms-2">Plan A Custom Trek</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar with Kunlun Logo -->
    <nav class="navbar navbar-expand-lg navbar-main sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Kunlun Treks and Tours" class="navbar-brand-logo">
                <div class="d-flex flex-column">
                    <span class="navbar-brand-text">KUNLUN <span>TREKS</span></span>
                    <span style="font-size: 0.6rem; letter-spacing: 1.8px; text-transform: uppercase; color: #111418; font-weight: 800; margin-top: -3px;">
                        AND TOURS PAKISTAN
                    </span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarKunlun">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarKunlun">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>

                    <!-- Categories Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('packages*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                            Adventures & Treks
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item fw-bold text-danger" href="{{ route('packages.index') }}"><i class="fas fa-th-large me-2 text-warning"></i>All Adventures</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach($globalMenuCategories as $cat)
                                <li>
                                    <a class="dropdown-item" href="{{ route('packages.category', $cat) }}">
                                        <i class="{{ $cat->icon_class ?: 'fas fa-mountain' }} me-2 text-danger" style="width: 16px;"></i>{{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('page/about-us*') ? 'active' : '' }}" href="{{ route('pages.show', 'about-us') }}">About Us</a>
                    </li>

                                        <li class="nav-item">
                        <a class="nav-link {{ request()->is('page/visa-information*') ? 'active' : '' }}" href="{{ route('pages.show', 'visa-information') }}">Visa & Info</a>
                    </li>
                    
                    @foreach($menuPages as $page)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('page/' . $page->slug . '*') ? 'active' : '' }}" href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a>
                    </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('faqs*') ? 'active' : '' }}" href="{{ route('faqs.index') }}">FAQs</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Expedition Journal</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>

                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="{{ route('contact') }}" class="btn btn-brand-primary btn-sm shadow-sm">
                            <i class="fas fa-paper-plane me-1"></i>Book Trek
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2 fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Floating WhatsApp Direct Chat -->
    @if(!empty($globalSettings['whatsapp_number']))
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $globalSettings['whatsapp_number']) }}?text=Hello%20Kunlun%20Treks,%20I%20would%20like%20to%20inquire%20about%20a%20tour" target="_blank" class="whatsapp-floating" title="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    @endif

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Kunlun Treks" style="height: 65px; width: auto;" class="bg-white p-1 rounded-2">
                        <div>
                            <h4 class="text-white mb-0 font-heading">KUNLUN TREKS</h4>
                            <small class="text-warning fw-bold text-uppercase" style="letter-spacing: 1.5px; font-size: 0.68rem;">AND TOURS PAKISTAN</small>
                        </div>
                    </div>
                    <p class="small text-muted mb-4">
                        Pakistan’s premier high-altitude mountaineering and wilderness trekking operator based in Skardu. Over 20 years guiding international adventurers across K2, Concordia, Broad Peak, and the Karakoram.
                    </p>
                    <div class="d-flex gap-2">
                        @foreach($globalSocialLinks as $social)
                            <a href="{{ $social->url }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="{{ $social->icon_class }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <h5 class="footer-heading">Adventures</h5>
                    <ul class="footer-links">
                        @foreach($globalMenuCategories as $cat)
                            <li><a href="{{ route('packages.category', $cat) }}"><i class="fas fa-chevron-right text-warning" style="font-size: 0.7rem;"></i>{{ $cat->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('packages.index') }}"><i class="fas fa-chevron-right text-warning" style="font-size: 0.7rem;"></i>All Packages</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                                        <h5 class="footer-heading">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('pages.show', 'about-us') }}">About Kunlun</a></li>
                        <li><a href="{{ route('pages.show', 'visa-information') }}">Pakistan e-Visa</a></li>
                        @foreach($footerPages as $page)
                        <li><a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a></li>
                        @endforeach
                        <li><a href="{{ route('faqs.index') }}">Trekker FAQs</a></li>
                        <li><a href="{{ route('blog.index') }}">Mountaineering Blog</a></li>
                        <li><a href="{{ route('pages.show', 'terms-and-conditions') }}">Terms & Conditions</a></li>
                        <li><a href="{{ route('pages.show', 'privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-heading">Expedition Headquarters</h5>
                    <p class="small text-muted mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i>{{ $globalSettings['address'] ?? 'Skardu, Gilgit-Baltistan, Pakistan' }}</p>
                    <p class="small text-muted mb-2"><i class="fas fa-envelope text-danger me-2"></i>{{ $globalSettings['email'] ?? 'info@kunluntreks.com' }}</p>
                    @if(!empty($globalSettings['phone']))
                        <p class="small text-muted mb-2"><i class="fas fa-phone text-danger me-2"></i>{{ $globalSettings['phone'] }}</p>
                    @endif
                    @if(!empty($globalSettings['whatsapp_number']))
                        <p class="small text-muted mb-3"><i class="fab fa-whatsapp text-success me-2"></i>{{ $globalSettings['whatsapp_number'] }}</p>
                    @endif

                    <div class="p-3 rounded bg-dark border border-secondary mt-3">
                        <div class="small text-white fw-bold mb-1"><i class="fas fa-shield-alt text-warning me-1"></i>Licensed Tour Operator</div>
                        <div class="small text-muted" style="font-size: 0.78rem;">Department of Tourist Services (DTS) Registered, Government of Pakistan.</div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div>
                    {{ $globalSettings['footer_text'] ?? '© ' . date('Y') . ' Kunlun Treks and Tours. All Rights Reserved.' }}
                </div>
                <div class="d-flex gap-3 small">
                    <a href="{{ route('pages.show', 'terms-and-conditions') }}" class="text-muted text-decoration-none">Terms</a>
                    <a href="{{ route('pages.show', 'privacy-policy') }}" class="text-muted text-decoration-none">Privacy</a>
                    <a href="{{ route('admin.login') }}" class="text-muted text-decoration-none"><i class="fas fa-lock me-1"></i>Staff Login</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // Sticky navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar-main').classList.add('scrolled');
            } else {
                document.querySelector('.navbar-main').classList.remove('scrolled');
            }
        });

        // Setup CSRF header for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @stack('scripts')
</body>
</html>

