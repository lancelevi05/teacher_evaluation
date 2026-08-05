<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>

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
                    {{ substr(Auth::user()->fname ?? '',0,1) }}
                    {{ substr(Auth::user()->lname ?? '',0,1) }}
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

                @if(!$teacher)

                    <div class="welcome-card">
                        <h1>Teacher Profile Not Found</h1>

                        <p>
                            Your teacher profile has not yet been created.
                            Please contact the administrator.
                        </p>
                    </div>

                @else

                {{-- Welcome --}}
                <div class="welcome-card">

                    <h1>
                        Welcome back,
                        {{ Auth::user()->fname }} 👋
                    </h1>

                    <p>
                        Here's a snapshot of your teaching performance.
                    </p>

                </div>

               

                {{-- Statistics --}}
                <div class="cards-grid">

                    {{-- Overall Rating --}}
                    <div class="stat-card">

                        <div class="stat-label">
                            OVERALL RATING
                        </div>

                        <div class="stat-value">

                            {{ $stats->a ? number_format($stats->a,2) : 'N/A' }}

                        </div>

                        <div class="stat-change">
                            Average evaluation score
                        </div>

                    </div>

                    {{-- Total Evaluations --}}
                    <div class="stat-card">

                        <div class="stat-label">
                            TOTAL EVALUATIONS
                        </div>

                        <div class="stat-value">

                            {{ $stats->c }}

                        </div>

                        <div class="stat-change">
                            Submitted by students
                        </div>

                    </div>

                    {{-- Subjects --}}
                    <div class="stat-card">

                        <div class="stat-label">
                            SUBJECTS HANDLED
                        </div>

                        <div class="stat-value">

                            {{ $subjects }}

                        </div>

                        <div class="stat-change">
                            Current assignments
                        </div>

                    </div>

                </div>

                {{-- Rating Trend --}}
                <section class="section-card">

                    <h2>
                        Rating Trend (Last 6 Months)
                    </h2>

                    @if($trend->isEmpty())

                        <p class="text-center py-4">
                            Not enough evaluation data yet.
                        </p>

                    @else

                        <canvas id="trendChart" height="90"></canvas>

                    @endif

                </section>

                {{-- Recent Summary --}}
                <section class="section-card">

                    <h2>
                        Performance Summary
                    </h2>

                    <div class="activity-item">
                        <span class="activity-dot"></span>
                        Average Rating:
                        <strong>
                            {{ $stats->a ? number_format($stats->a,2) : 'N/A' }}
                        </strong>
                    </div>

                    <div class="activity-item">
                        <span class="activity-dot"></span>
                        Total Evaluations:
                        <strong>
                            {{ $stats->c }}
                        </strong>
                    </div>

                    <div class="activity-item">
                        <span class="activity-dot"></span>
                        Subjects Handled:
                        <strong>
                            {{ $subjects }}
                        </strong>
                    </div>

                </section>

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

@if($teacher && !$trend->isEmpty())

<script>

new Chart(document.getElementById('trendChart'),{

    type:'line',

    data:{

        labels:[
            @foreach($trend as $row)
                "{{ $row->ym }}",
            @endforeach
        ],

        datasets:[{

            label:'Average Rating',

            data:[
                @foreach($trend as $row)
                    {{ round($row->avg_rating,2) }},
                @endforeach
            ],

            borderColor:'#4338CA',

            backgroundColor:'rgba(67,56,202,.15)',

            fill:true,

            tension:.4

        }]

    },

    options:{

        responsive:true,

        plugins:{
            legend:{
                display:false
            }
        },

        scales:{
            y:{
                beginAtZero:true,
                max:5
            }
        }

    }

});

</script>

@endif

</body>

</html>