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
                        <p id="welcomeText">Here's what's happening with your projects today.</p>
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
                                Revenue
                            </div>
                            <div class="stat-value">
                                $24.8k
                            </div>
                            <div class="stat-change">
                                ↑ 12% this month
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">
                                Users
                            </div>
                            <div class="stat-value">
                                1,842
                            </div>
                            <div class="stat-change">
                                ↑ 8% this week
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
                        <div class="activity-item">
                            <span class="activity-dot"></span>New user signup — Sarah M.
                        </div>
                        <div class="activity-item">
                            <span class="activity-dot"></span>Project "Alpha" updated by team lead
                        </div>
                        <div class="activity-item">
                            <span class="activity-dot"></span>Invoice #1042 paid — $1,200
                        </div>
                        <div class="activity-item">
                            <span class="activity-dot"></span>Server migration completed successfully
                        </div>
                    </section>
                </main>
            </div>
        </div>
        <footer class="app-footer"><span id="footerText">© 2025 Dashboard — Built with care.</span>
        </footer>
    </div>


    @include('AdminSide.javascript')
</body>

</html>