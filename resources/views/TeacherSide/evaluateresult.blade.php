<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        .evaluation-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 20px;
            margin-bottom: 20px;
            align-items: stretch;
        }

        .evaluation-grid .panel {
            height: 100%;
        }

        .evaluation-grid canvas {
            width: 100% !important;
            height: 280px !important;
        }

        @media (max-width:900px) {

            .evaluation-grid {
                grid-template-columns: 1fr;
            }

        }

        .panel {
            background-color: white;
            padding: 34px;
            border-radius: 10px;
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

    @include('StudentSide.css')

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="height:100%;margin:0">

    <div class="app-wrapper">
        <div class="app-body">

            {{-- Sidebar --}}
            @include('TeacherSide.dashboard')

            {{-- Main Area --}}
            <div class="main-area">

                {{-- Top Navigation --}}
                <header class="top-bar">

                    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
                        ☰
                    </button>

                    <span class="top-bar-title">
                        Teacher Dashboard
                    </span>

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

                            <button class="dropdown-item logout-btn">
                                Logout
                            </button>

                        </form>

                    </div>

                </header>

                {{-- Content --}}
                <main class="content">

                    <div class="section-header01">

                        <div class="section-title01">
                            <h2>My Evaluation</h2>
                            <p>Overview of how students have rated you.</p>
                        </div>



                    </div>

                    <div class="evaluation-grid">

                        <div class="panel text-center">

                            <div class="rating-score">
                                {{ $stats->a ? number_format($stats->a, 2) : '—' }}
                            </div>

                            <div style="font-size:1.4rem;color:#F59E0B">
                                {!! $starHtml !!}
                            </div>

                            <span class="rating-badge {{ $badgeClass }} mt-2">
                                {{ $ratingLabel }}
                            </span>

                            <p class="subtle mt-3 mb-0">
                                Based on {{ $stats->c }}
                                evaluation{{ $stats->c != 1 ? 's' : '' }}
                            </p>

                        </div>

                        <div class="panel">

                            <div class="section-title">
                                Category Breakdown
                            </div>

                            @if($categories->isEmpty())

                                <p class="subtle text-center py-4">
                                    No evaluation data yet.
                                </p>

                            @else

                                <canvas id="catChart"></canvas>

                            @endif

                        </div>

                    </div>

                    <div class="panel">

                        <div class="section-title mb-3">

                            Performance by Subject

                        </div>

                        @if($subjectRows->isEmpty())

                            <p>No subject-level data yet.</p>

                        @else

                            <table class="sections-table" style="width:100%">

                                <thead>

                                    <tr>

                                        <th>Subject</th>
                                        <th>Evaluations</th>
                                        <th>Average Rating</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($subjectRows as $s)

                                        <tr>

                                            <td>

                                                {{ $s->code }} — {{ $s->subject_name }}

                                            </td>

                                            <td>

                                                {{ $s->n }}

                                            </td>

                                            <td>

                                                <span class="rating-badge {{ $s->badgeClass }}">

                                                    {{ number_format($s->avg_rating, 2) }}

                                                </span>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        @endif

                    </div>

                    <div class="text-end mt-3">

                        <a href="{{ route('teacher.evalresult.print') }}" class="btn btn-outline-primary" target="_blank">

                            <i class="fa-solid fa-print me-2"></i>

                            Print / Save as PDF

                        </a>

                    </div>

                    @if(!$categories->isEmpty())

                        <script>

                            new Chart(document.getElementById('catChart'), {

                                type: 'bar',

                                data: {

                                    labels: @json($categories->pluck('category')),

                                    datasets: [{

                                        label: 'Average Rating',

                                        data: @json($categories->pluck('avg_rating')->map(fn($v) => round($v, 2))),

                                        backgroundColor: '#4338CA',

                                        borderRadius: 6

                                    }]

                                },

                                options: {

                                    indexAxis: 'y',

                                    scales: {

                                        x: {

                                            min: 0,

                                            max: 5

                                        }

                                    },

                                    plugins: {

                                        legend: {

                                            display: false

                                        }

                                    }

                                }

                            });

                        </script>

                    @endif

                </main>

            </div>

        </div>

        <footer class="app-footer">
            <span id="footerText">
                © {{ date('Y') }} Teacher Evaluation System
            </span>
        </footer>

    </div>

    @include('TeacherSide.javascript')


</body>

</html>