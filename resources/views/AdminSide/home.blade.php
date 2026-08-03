<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('AdminSide.css')
</head>

<body style="height:100%;margin:0">
    <div class="app-wrapper">
        <div class="app-body">
            <!-- Sidebar -->
            @include('AdminSide.dashboard')
            <!-- Sidebar -->

            <!-- Main Content -->
            <div class="main-area">
                <header class="top-bar"><button class="mobile-menu-btn" id="mobileMenuBtn"
                        aria-label="Toggle menu">☰</button><span class="top-bar-title">Admin Side</span>
                    <div class="avatar" id="avatarToggle">
                        {{ substr(Auth::user()->fname ?? '', 0, 1) }}
                        {{ substr(Auth::user()->lname ?? '', 0, 1) }}
                    </div>



                    <div class="nav-dropdown" id="navDropdown">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            Profile Settings
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">
                                Logout
                            </button>
                        </form>
                    </div>



                </header>
                <main class="content">
                    <div class="welcome-card">
                        <h1 id="welcomeHeading">Welcome back,
                            {{ Auth::user()->fname }}
                        </h1>
                        <p id="welcomeText">Here's what's happening across the system.</p>
                    </div><button class="expand-button" id="expandBtn">⋮ Expand Details</button>
                    <div class="expand-panel" id="expandPanel">
                        <div class="expand-line">
                            📊 Dashboard updated 2 hours ago
                        </div>
                        <div class="expand-line">
                            🎯 All systems operating normally
                        </div>
                        <div class="expand-line">
                            🔔 2 pending notifications
                        </div>
                    </div>
                    <div class="cards-grid">
                        <div class="stat-card">
                            <div class="stat-label">
                                TOTAL STUDENTS
                            </div>
                            <div class="stat-value">
                                {{ $totalstudents }}
                            </div>
                            <div class="stat-change">
                                <!-- ↑ 12% this month -->
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">
                                TOTAL TEACHERS
                            </div>
                            <div class="stat-value">
                                {{ $totalteachers }}
                            </div>
                            <div class="stat-change">
                                <!-- ↑ 8% this week -->
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">
                                DEPARTMENT
                            </div>
                            <div class="stat-value">
                                {{ $totaldepartments }}
                            </div>
                            <div class="stat-change">
                                <!-- ↑ 8% this week -->
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">
                                COURSES
                            </div>
                            <div class="stat-value">
                                {{ $totalcourses }}
                            </div>
                            <div class="stat-change">
                                <!-- ↑ 8% this week -->
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">
                                Projects
                            </div>
                            <div class="stat-value">
                                36
                            </div>
                            <div class="stat-change">
                                ↑ 3 new
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">
                                Tasks
                            </div>
                            <div class="stat-value">
                                128
                            </div>
                            <div class="stat-change">
                                ↑ 24 completed
                            </div>
                        </div>
                    </div>
                    <section class="section-card">

                        <h2>Recent Activity</h2>
                        @foreach($auditLogs as $log)
                                            <div class="activity-item">
                                                <div>
                                                    <span class="activity-dot"></span>
                                                    {{ $log->user
                            ? trim($log->user->fname . ' ' . $log->user->lname)
                            : 'Deleted user' }} -
                                                    {{ $log->action }}
                                                    {{ $log->details }}
                                                </div>

                                                <span class="activity-date">
                                                    {{ $log->created_at->format('M d, Y h:i A') }}
                                                </span>
                                            </div>
                        @endforeach
                    </section>
                </main>
            </div>
        </div>

        @include('AdminSide.z-footer')
    </div>


    @include('AdminSide.javascript')
</body>

</html>