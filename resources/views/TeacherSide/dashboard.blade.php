<!-- Sidebar -->
<aside class="sidebar" role="navigation" aria-label="Main navigation">
    <div class="sidebar-brand" id="sidebarBrand">
        Dashboard
    </div>
    <nav class="sidebar-nav"><span class="nav-label">Menu</span>

        <a class="nav-item {{ request()->routeIs('TeacherSide.home') ? 'active' : '' }}"
            href="{{ route('TeacherSide.home') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg> Dashboard
        </a>

        <a class="nav-item {{ request()->routeIs('evaluateresult*') ? 'active' : '' }}"
            href="{{ route('evaluateresult.index') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 2h6a1 1 0 011 1v1H8V3a1 1 0 011-1z" />
                <rect x="4" y="4" width="16" height="18" rx="2" />
                <path d="M9 13l2 2 4-4" />
            </svg> My Evaluation
        </a>

        <a class="nav-item {{ request()->routeIs('comments*') ? 'active' : '' }}"
            href="{{ route('comments.index') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 2h6a1 1 0 011 1v1H8V3a1 1 0 011-1z" />
                <rect x="4" y="4" width="16" height="18" rx="2" />
                <path d="M9 13l2 2 4-4" />
            </svg> Student Comments
        </a>

        <a class="nav-item {{ request()->routeIs('aisuggestions*') ? 'active' : '' }}"
            href="{{ route('aisuggestions.index') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 2h6a1 1 0 011 1v1H8V3a1 1 0 011-1z" />
                <rect x="4" y="4" width="16" height="18" rx="2" />
                <path d="M9 13l2 2 4-4" />
            </svg> AI Suggestions
        </a>

       

    </nav>
</aside>
<!-- Sidebar -->