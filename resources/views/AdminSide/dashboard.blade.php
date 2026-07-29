<!-- Sidebar -->
<aside class="sidebar" role="navigation" aria-label="Main navigation">
    <div class="sidebar-brand" id="sidebarBrand">
        Dashboard
    </div>
    <nav class="sidebar-nav">
        <a class="nav-item {{ request()->routeIs('AdminSide.home') ? 'active' : '' }}"
            href="{{ route('AdminSide.home') }}">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg> Overview </a>
        <span class="nav-label">ACADEMIC STRUCTURE</span>



        <a class="nav-item {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 10L12 5 2 10l10 5 10-5z" />
                <path d="M6 12v5c0 1.5 3 3 6 3s6-1.5 6-3v-5" />
            </svg>Courses </a>

        <a class="nav-item {{ request()->routeIs('subjects.*') ? 'active' : '' }}" href="{{ route('subjects.index') }}">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a4 4 0 0 0-4-4H2z" />
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a4 4 0 0 1 4-4h6z" />
            </svg>Subject </a>


        <a class="nav-item {{ request()->routeIs('departments.*') ? 'active' : '' }}"
            href="{{ route('departments.index') }}">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 21h18" />
                <path d="M5 21V7l7-4 7 4v14" />
                <path d="M9 10h.01" />
                <path d="M15 10h.01" />
                <path d="M9 14h.01" />
                <path d="M15 14h.01" />
                <path d="M11 21v-3h2v3" />
            </svg>Department </a>

        <a class="nav-item {{ request()->routeIs('academicsemesters.*') ? 'active' : '' }}"
            href="{{ route('academicsemesters.index') }}">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
            </svg> Semesters </a>

        <span class="nav-label" style="margin-top:12px">PEOPLE</span>

        <a class="nav-item {{ request()->routeIs('teachers*') ? 'active' : '' }}" href="{{ route('teachers.index') }}">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M2 3h20" />
                <path d="M21 3v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3" />
                <path d="m7 21 5-5 5 5" />
            </svg> Teacher </a>

        <a class="nav-item {{ request()->routeIs('students*') ? 'active' : '' }}" href="{{ route('students.index') }}">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4" />
                <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
            </svg> Students </a>
        <span class="nav-label" style="margin-top:12px">Evaluation</span>

        <a class="nav-item {{ request()->routeIs('questionnaire*') ? 'active' : '' }}"
            href="{{ route('questionnaire.index') }}">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="8" y="2" width="8" height="4" rx="1" ry="1" />
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                <path d="M12 11h4" />
                <path d="M12 16h4" />
                <path d="M8 11h.01" />
                <path d="M8 16h.01" />
            </svg> Questionnaire </a>


        <a class="nav-item {{ request()->routeIs('teacherassignment*') ? 'active' : '' }}"
            href="{{ route('teacherassignment.index') }}">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="8" y="2" width="8" height="4" rx="1" ry="1" />
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                <path d="M12 11h4" />
                <path d="M12 16h4" />
                <path d="M8 11h.01" />
                <path d="M8 16h.01" />
            </svg> Subject Assignments</a>

        <span class="nav-label" style="margin-top:12px">System</span>

        <a class="nav-item {{ request()->routeIs('auditLogs*') ? 'active' : '' }}"
            href="{{ route('auditLogs.index') }}">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3" />
                <path
                    d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
            </svg> Audit Logs </a>






        <span class="nav-label" style="margin-top:12px">Settings</span>
        <a class="nav-item" href="#">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3" />
                <path
                    d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
            </svg> Settings </a>

        <a class="nav-item" href="#">
            <svg class="nav-icon" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4-4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
            </svg> Profile Settings </a>
    </nav>
</aside>
<!-- Sidebar -->