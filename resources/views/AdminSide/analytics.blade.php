<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('AdminSide.css')
    <style>
    /* ===== AI Analytics content styling ===== */
    .content {
        padding: 32px;
        background: #f4f5f9;
    }

    .content h4.fw-bold {
        font-size: 1.6rem;
        color: #1f2333;
    }

    .content .subtle {
        color: #8a8fa3;
        font-size: 0.92rem;
    }

    /* ---- Grid layout override ---- */
    .content .row {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 24px;
        margin: 0 0 24px 0;
    }

    .content .row.g-3,
    .content .row.g-2 {
        gap: 24px;
    }

    .content .col-lg-4 { grid-column: span 4; }
    .content .col-lg-6 { grid-column: span 6; }
    .content .col-lg-8 { grid-column: span 8; }
    .content .col-md-6 { grid-column: span 6; }

    @media (max-width: 992px) {
        .content .col-lg-4,
        .content .col-lg-6,
        .content .col-lg-8,
        .content .col-md-6 {
            grid-column: span 12;
        }
    }

    /* Card / panel */
    .content .panel {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #eef0f5;
        box-shadow: 0 2px 10px rgba(20, 20, 43, 0.04);
        padding: 24px;
        height: 100%;
    }

    .content .panel.text-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Section titles inside cards */
    .content .section-title {
        font-weight: 700;
        font-size: 1.05rem;
        color: #1f2333;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
    }

    .content .section-title.text-success {
        color: #17a673 !important;
    }

    .content .section-title.text-danger {
        color: #e0435c !important;
    }

    .content .section-title i {
        font-size: 0.95rem;
    }

    /* Avatar circle (teacher initial) */
    .content .avatar-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #ece9fd;
        color: #4338CA;
        font-weight: 700;
    }

    /* Overall rating number */
    .content .text-brand {
        color: #4338CA !important;
    }

    .content .display-6.fw-bold {
        font-size: 2.6rem;
        line-height: 1.1;
    }

    /* Rating badge (e.g. "Very Good") */
    .content .badge {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .content .badge.bg-success  { background-color: #17a673 !important; color: #fff; }
    .content .badge.bg-info     { background-color: #4338CA !important; color: #fff; }
    .content .badge.bg-warning  { background-color: #f4a223 !important; color: #fff; }
    .content .badge.bg-danger   { background-color: #e0435c !important; color: #fff; }
    .content .badge.bg-secondary{ background-color: #9297a8 !important; color: #fff; }

    /* Keyword pills */
    .content .badge-soft-info {
        background: #eef0fb;
        color: #4338CA;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.82rem;
        display: inline-block;
    }

    /* Strengths / weaknesses / recommendations lists */
    .content .panel ul {
        padding-left: 18px;
        margin: 0;
    }

    .content .panel ul li {
        margin-bottom: 6px;
        color: #3c3f4c;
        font-size: 0.95rem;
    }

    /* Teacher select panel */
    .content form .form-label {
        font-weight: 600;
        color: #1f2333;
        margin-bottom: 6px;
        display: block;
    }

    .content form .form-select {
        border-radius: 10px;
        border: 1px solid #e2e4ec;
        padding: 10px 14px;
        font-size: 0.95rem;
        width: 100%;
    }

    /* Radar chart container height */
    .content #radarChart {
        max-height: 260px;
    }

    .rating-badge {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            letter-spacing: 0.3px;
        }

        .performance-excellent {
            background: #d4edda;
            color: #1e7e34;
        }

        .performance-good {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .performance-average {
            background: #fff3cd;
            color: #92700f;
        }

        .performance-poor {
            background: #fdecea;
            color: #a12622;
        }

        .performance-nodata {
            background: #eee;
            color: #888;
        }
        .rating-score {
    font-size: 3rem;      /* Bootstrap's display-5 is ~3rem / 48px */
    font-weight: 700;     /* fw-bold */
    line-height: 1.2;
    color: #4338CA;       /* matches the --brand blue used in your chart bars */
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

                   <div class="section-header01">
                        <div class="section-title01">
                            <h2>Analytics</h2>
                            <p>Automatic sentiment analysis, keyword extraction, and performance
                            recommendations.</p>
                        </div>
                    </div>

                    <div class="panel mb-4">
                        <form method="GET" action="{{ route('analytics.index') }}" class="row g-2 align-items-end">
                            <div class="col-md-6">
                                <label class="form-label">Select Teacher</label>
                                <select name="teacher_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">-- Choose a teacher --</option>
                                    @foreach ($teachers as $t)
                                        <option value="{{ $t->id }}" {{ (string) $teacherId === (string) $t->id ? 'selected' : '' }}>
                                            {{ $t->fname }}  {{ $t->lname }}
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
                                    <h5 class="fw-bold mb-0">{{ $selectedTeacher->fname }} {{ $selectedTeacher->lname }}</h5>
                                    <div class="my-3">
                                        <div class="rating-score">
                                            {{ $summary['overall_rating'] ? number_format($summary['overall_rating'], 2) : '—' }}
                                        </div>
                                        <span
                                            class="rating-badge {{ $analysis->ratingBadgeClass($summary['overall_rating']) }}">
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