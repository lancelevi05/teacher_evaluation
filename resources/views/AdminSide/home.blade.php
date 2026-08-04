<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('AdminSide.css')
    <style>
        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .analytics-grid .section-card {
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 320px;
        }

        .analytics-grid .section-card canvas {
            flex: 1;
            max-height: 260px;
        }

        @media (max-width: 900px) {
            .analytics-grid {
                grid-template-columns: 1fr;
            }
        }

        .sections-table th {
            background: #f3f2fb;
            color: #4b3cc9;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.03em;
            text-align: left;
            padding: 12px;
        }

        .sections-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #1a1a2e;
        }
    </style>
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

                    <div class="analytics-grid">
                        <section class="section-card">
                            <h2>Monthly Evaluations</h2>
                            <p class="subtle">Submissions over the last 6 months</p>
                            <canvas id="monthlyChart" height="110"></canvas>
                        </section>

                        <section class="section-card">
                            <h2>Rating Distribution</h2>
                            <p class="subtle">Spread of overall evaluation scores</p>
                            <canvas id="distChart" height="130"></canvas>
                        </section>

                        <section class="section-card">
                            <h2>Top Rated Teachers</h2>
                            <p class="subtle">Based on average evaluation score</p>
                            @if($topTeachers->isEmpty())
                                <p>No evaluation data yet.</p>
                            @else
                                <div class="table-wrapper">
                                    <table style="width:100%" class="sections-table">
                                        <thead>
                                            <tr>
                                                <th>Teacher</th>
                                                <th>Avg Rating</th>
                                                <th>Evaluations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($topTeachers as $t)
                                                <tr>
                                                    <td>{{ $t->name }}</td>
                                                    <td>{{ number_format($t->avg_rating, 2) }}</td>
                                                    <td>{{ $t->total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </section>

                        <section class="section-card">
                            <h2>Department Comparison</h2>
                            <p class="subtle">Average teacher rating per department</p>
                            <canvas id="deptChart" height="130"></canvas>
                        </section>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const monthlyLabels = @json($monthly->pluck('ym'));
        const monthlyData = @json($monthly->pluck('c'));
        new Chart(document.getElementById('monthlyChart'), {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Evaluations',
                    data: monthlyData,
                    borderColor: '#4338CA',
                    backgroundColor: 'rgba(67,56,202,.1)',
                    fill: true,
                    tension: .35
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
            }
        });

        const distLabels = @json($ratingDist->pluck('r')->map(fn($r) => $r . ' Star'));
        const distData = @json($ratingDist->pluck('c'));
        new Chart(document.getElementById('distChart'), {
            type: 'doughnut',
            data: {
                labels: distLabels,
                datasets: [{
                    data: distData,
                    backgroundColor: ['#DC2626', '#D97706', '#FACC15', '#0EA5A4', '#16A34A']
                }]
            },
            options: {
                plugins: { legend: { position: 'bottom' } }
            }
        });

        const deptLabels = @json($deptComparison->pluck('name'));
        const deptData = @json($deptComparison->pluck('avg_rating')->map(fn($v) => round($v, 2)));
        new Chart(document.getElementById('deptChart'), {
            type: 'bar',
            data: {
                labels: deptLabels,
                datasets: [{
                    label: 'Avg Rating',
                    data: deptData,
                    backgroundColor: '#0EA5A4',
                    borderRadius: 6
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, max: 5 } }
            }
        });
    </script>
    @include('AdminSide.javascript')
</body>

</html>