<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        :root {
            --brand: #4338CA;
            --brand-dark: #362CA0;
            --brand-light: #E4E1FB;
            --bg: #F4F5FA;
            --panel-bg: #FFFFFF;
            --text-main: #1F2333;
            --text-subtle: #8A8FA3;
            --border: #ECEDF3;
            --success: #16A34A;
            --success-bg: #E9F9EE;
            --danger: #DC2626;
            --danger-bg: #FDECEC;
            --info-bg: #EFF1FE;
            --info-text: #4338CA;
            --radius: 14px;
            --shadow: 0 2px 10px rgba(31, 35, 51, 0.06);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: var(--bg);
            color: var(--text-main);
            margin: 0;
            height: 100%;
        }

        .app-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .app-body {
            display: flex;
            flex: 1;
        }

        /* ---------- Sidebar ---------- */
        .sidebar {
            width: 250px;
            background: var(--panel-bg);
            border-right: 1px solid var(--border);
            padding: 20px 14px;
            flex-shrink: 0;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--brand);
            padding: 6px 10px 22px;
        }

        .sidebar-section-label {
            text-transform: uppercase;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: .06em;
            color: var(--text-subtle);
            margin: 18px 10px 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: var(--text-main);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.92rem;
            margin-bottom: 2px;
        }

        .sidebar-link:hover {
            background: var(--info-bg);
        }

        .sidebar-link.active {
            background: var(--brand);
            color: #fff;
            box-shadow: var(--shadow);
        }

        .sidebar-link i,
        .sidebar-link svg {
            width: 18px;
            text-align: center;
        }

        /* ---------- Main area ---------- */
        .main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .top-bar {
            background: linear-gradient(90deg, var(--brand), var(--brand-dark));
            color: #fff;
            display: flex;
            align-items: center;
            padding: 14px 24px;
            gap: 14px;
        }

        .top-bar-title {
            font-weight: 700;
            font-size: 1.05rem;
        }

        .mobile-menu-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.2rem;
            display: none;
            cursor: pointer;
        }

        .avatar {
            margin-left: auto;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
        }

        .nav-dropdown {
            position: absolute;
            right: 24px;
            top: 60px;
            background: #fff;
            border-radius: 10px;
            box-shadow: var(--shadow);
            min-width: 180px;
            overflow: hidden;
            display: none;
            z-index: 20;
        }

        .nav-dropdown.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 10px 16px;
            background: none;
            border: none;
            text-align: left;
            color: var(--text-main);
            text-decoration: none;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: var(--info-bg);
        }

        .logout-btn {
            color: var(--danger);
        }

        .content {
            padding: 26px 28px 40px;
        }

        /* ---------- Typography helpers ---------- */
        .fw-bold {
            font-weight: 700;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .subtle {
            color: var(--text-subtle);
        }

        .text-brand {
            color: var(--brand);
        }

        .display-6 {
            font-size: 2.6rem;
            line-height: 1.1;
        }

        /* ---------- Panels / Cards ---------- */
        .panel {
            background: var(--panel-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 22px;
        }

        .row.g-3 > * {
            padding: 10px;
        }

        .row.g-2 > * {
            padding: 6px;
        }

        .section-title {
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            margin-bottom: 14px;
        }

        .section-title.text-success {
            color: var(--success);
        }

        .section-title.text-danger {
            color: var(--danger);
        }

        .panel ul {
            padding-left: 18px;
            margin: 0;
        }

        .panel ul li {
            margin-bottom: 6px;
            font-size: 0.92rem;
        }

        /* ---------- Avatar circle (teacher initial) ---------- */
        .avatar-circle {
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* ---------- Badges ---------- */
        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #fff;
        }

        .bg-success { background: var(--success); }
        .bg-danger  { background: var(--danger); }
        .bg-warning { background: #D97706; }
        .bg-info    { background: var(--brand); }
        .bg-secondary { background: #6B7280; }

        .badge-soft-info {
            display: inline-block;
            background: var(--info-bg);
            color: var(--info-text);
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* ---------- Form controls ---------- */
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 6px;
            display: block;
        }

        .form-select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #fff;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .form-select:focus {
            outline: none;
            border-color: var(--brand);
        }

        /* ---------- Grid helpers (in case Bootstrap grid isn't loaded) ---------- */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .col-md-6 { flex: 0 0 50%; max-width: 50%; }
        .col-lg-4 { flex: 0 0 33.3333%; max-width: 33.3333%; }
        .col-lg-6 { flex: 0 0 50%; max-width: 50%; }
        .col-lg-8 { flex: 0 0 66.6666%; max-width: 66.6666%; }
        .h-100 { height: 100%; }
        .text-center { text-align: center; }
        .mx-auto { margin-left: auto; margin-right: auto; }
        .align-items-end { align-items: flex-end; }
        .py-5 { padding-top: 3rem; padding-bottom: 3rem; }

        @media (max-width: 900px) {
            .sidebar { display: none; }
            .mobile-menu-btn { display: block; }
            .col-lg-4, .col-lg-6, .col-lg-8, .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
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

                    <div class="mb-4">
                        <h4 class="fw-bold mb-0">AI Analytics</h4>
                        <p class="subtle mb-0">Automatic sentiment analysis, keyword extraction, and performance
                            recommendations.</p>
                    </div>

                    <div class="panel mb-4">
                        <form method="GET" action="{{ route('analytics.index') }}" class="row g-2 align-items-end">
                            <div class="col-md-6">
                                <label class="form-label">Select Teacher</label>
                                <select name="teacher_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">-- Choose a teacher --</option>
                                    @foreach ($teachers as $t)
                                        <option value="{{ $t->id }}" {{ (string) $teacherId === (string) $t->id ? 'selected' : '' }}>
                                            {{ $t->fname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                    @if ($selectedTeacher && $summary)
                        <div class="row g-3">
                            <div class="col-lg-4">
                                <div class="panel text-center">
                                    <div class="avatar-circle mx-auto mb-2"
                                        style="width:60px;height:60px;font-size:1.4rem;background:var(--brand-light);color:var(--brand)">
                                        {{ strtoupper(substr($selectedTeacher->fname, 0, 1)) }}
                                    </div>
                                    <h5 class="fw-bold mb-0">{{ $selectedTeacher->fname }}</h5>
                                    <div class="my-3">
                                        <div class="display-6 fw-bold text-brand">
                                            {{ $summary['overall_rating'] ? number_format($summary['overall_rating'], 2) : '—' }}
                                        </div>
                                        <span
                                            class="badge bg-{{ $analysis->ratingBadgeClass($summary['overall_rating']) }}">
                                            {{ $summary['overall_label'] }}
                                        </span>
                                    </div>
                                    <p class="subtle small">
                                        Positive comments: {{ $summary['sentiment_counts']['positive'] }} ·
                                        Negative: {{ $summary['sentiment_counts']['negative'] }} ·
                                        Neutral: {{ $summary['sentiment_counts']['neutral'] }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="panel h-100">
                                    <div class="section-title">Category Radar</div>
                                    <canvas id="radarChart" height="180"></canvas>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="panel h-100">
                                    <div class="section-title text-success"><i
                                            class="fa-solid fa-thumbs-up me-2"></i>Strengths</div>
                                    @if (empty($summary['strengths']))
                                        <p class="subtle">No standout strengths detected yet.</p>
                                    @else
                                        <ul class="mb-0">
                                            @foreach ($summary['strengths'] as $s)
                                                <li>{{ $s }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="panel h-100">
                                    <div class="section-title text-danger"><i
                                            class="fa-solid fa-thumbs-down me-2"></i>Weaknesses</div>
                                    @if (empty($summary['weaknesses']))
                                        <p class="subtle">No significant weaknesses detected.</p>
                                    @else
                                        <ul class="mb-0">
                                            @foreach ($summary['weaknesses'] as $w)
                                                <li>{{ $w }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="panel h-100">
                                    <div class="section-title"><i class="fa-solid fa-tags me-2"></i>Common Keywords</div>
                                    @if (empty($summary['keywords']))
                                        <p class="subtle">Not enough comment data yet.</p>
                                    @else
                                        @foreach ($summary['keywords'] as $kw)
                                            <span class="badge badge-soft-info me-1 mb-1">{{ $kw }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="panel h-100">
                                    <div class="section-title"><i class="fa-solid fa-lightbulb me-2"></i>Recommendations
                                    </div>
                                    <ul class="mb-0">
                                        @foreach ($summary['recommendations'] as $r)
                                            <li>{{ $r }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <script>
                            const radarLabels = @json(array_keys($categoryAverages));
                            const radarData = @json(array_values($categoryAverages));
                            new Chart(document.getElementById('radarChart'), {
                                type: 'radar',
                                data: {
                                    labels: radarLabels,
                                    datasets: [{
                                        label: 'Avg Rating',
                                        data: radarData,
                                        backgroundColor: 'rgba(67,56,202,.2)',
                                        borderColor: '#4338CA',
                                        pointBackgroundColor: '#4338CA'
                                    }]
                                },
                                options: {
                                    scales: {
                                        r: { min: 0, max: 5, ticks: { stepSize: 1 } }
                                    }
                                }
                            });
                        </script>

                    @elseif ($selectedTeacher)
                        <div class="panel text-center py-5 subtle">No evaluation data yet for this teacher.</div>
                    @else
                        <div class="panel text-center py-5 subtle">Select a teacher above to view their AI-generated
                            performance analysis.</div>
                    @endif

                </main>
            </div>
        </div>

        @include('AdminSide.z-footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @include('AdminSide.javascript')
</body>

</html>