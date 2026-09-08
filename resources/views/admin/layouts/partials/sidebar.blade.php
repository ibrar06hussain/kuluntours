<aside class="admin-sidebar">
    <div class="brand d-flex align-items-center gap-3">
        <img src="{{ asset('images/logo.png') }}" alt="Kunlun Logo" style="height: 42px; width: auto; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.5));">
        <div>
            <h4 style="color: #ffffff; font-weight: 800; font-size: 1.05rem; margin: 0; line-height: 1.1;"><span style="color: var(--accent);">KUNLUN</span> TREKS</h4>
            <small style="color: #F87171; font-size: 0.65rem; letter-spacing: 1.8px; font-weight: 700;">EXPEDITION SUITE</small>
        </div>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>

        <li class="menu-header">Content</li>
        <li>
            <a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Hero Sliders
            </a>
        </li>
        <li>
            <a href="{{ route('admin.homepage-sections.index') }}" class="{{ request()->routeIs('admin.homepage-sections*') ? 'active' : '' }}">
                <i class="fas fa-puzzle-piece"></i> Homepage Sections
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> CMS Pages
            </a>
        </li>

        <li class="menu-header">Tours & Treks</li>
        <li>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <i class="fas fa-folder"></i> Categories
            </a>
        </li>
        <li>
            <a href="{{ route('admin.packages.index') }}" class="{{ request()->routeIs('admin.packages*') ? 'active' : '' }}">
                <i class="fas fa-suitcase-rolling"></i> Packages & Itineraries
            </a>
        </li>

        <li class="menu-header">Customer Engagement</li>
        <li>
            <a href="{{ route('admin.inquiries.index') }}" class="{{ request()->routeIs('admin.inquiries*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Inquiries & Bookings
            </a>
        </li>
        <li>
            <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
                <i class="fas fa-quote-right"></i> Testimonials
            </a>
        </li>
        <li>
            <a href="{{ route('admin.team-members.index') }}" class="{{ request()->routeIs('admin.team-members*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Team Members
            </a>
        </li>
        <li>
            <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs*') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i> FAQs
            </a>
        </li>
        <li>
            <a href="{{ route('admin.blog-posts.index') }}" class="{{ request()->routeIs('admin.blog-posts*') ? 'active' : '' }}">
                <i class="fas fa-blog"></i> Blog Posts
            </a>
        </li>

        <li class="menu-header">System Settings</li>
        <li>
            <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> Site Settings
            </a>
        </li>
        <li>
            <a href="{{ route('admin.social-links.index') }}" class="{{ request()->routeIs('admin.social-links*') ? 'active' : '' }}">
                <i class="fas fa-share-alt"></i> Social Media Links
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i> User Management
            </a>
        </li>
        <li>
            <a href="{{ route('admin.media.index') }}" class="{{ request()->routeIs('admin.media*') ? 'active' : '' }}">
                <i class="fas fa-photo-video"></i> Media Library
            </a>
        </li>
    </ul>
</aside>
