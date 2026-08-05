<!-- Sidebar -->
<aside class="sidebar" role="navigation" aria-label="Main navigation">
    <div class="sidebar-brand" id="sidebarBrand">
        Dashboard
    </div>
    <nav class="sidebar-nav"><span class="nav-label">Menu</span>

        <a class="nav-item {{ request()->routeIs('StudentSide.home') ? 'active' : '' }}"
            href="{{ route('StudentSide.home') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg> Dashboard
        </a>

        <a class="nav-item {{ request()->routeIs('student.evaluate*') ? 'active' : '' }}"
            href="{{ route('student.evaluate') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 2h6a1 1 0 011 1v1H8V3a1 1 0 011-1z" />
                <rect x="4" y="4" width="16" height="18" rx="2" />
                <path d="M9 13l2 2 4-4" />
            </svg> Evaluate Teacher
        </a>

        <a class="nav-item {{ request()->routeIs('student.history*') ? 'active' : '' }}"
            href="{{ route('student.history') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8" />
                <path d="M3 3v5h5" />
                <path d="M12 7v5l4 2" />
            </svg> Evaluation History
        </a>

        <a class="nav-item {{ request()->routeIs('infosettings*') ? 'active' : '' }}"
            href="{{ route('infosettings') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="10" cy="8" r="4" />
                <path d="M2 21v-1a6 6 0 016-6h1" />
                <circle cx="18" cy="17" r="3" />
                <path d="M18 14v.5M18 19.5V20M15.5 15.5l.35.35M20.15 18.15l.35.35M15.5 18.5l.35-.35M20.15 15.85l.35-.35" />
            </svg> Profile Settings
        </a>

    </nav>
</aside>
<!-- Sidebar -->