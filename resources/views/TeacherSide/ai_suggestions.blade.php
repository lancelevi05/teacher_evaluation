<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Suggestions</title>

    @include('StudentSide.css')

    <style>
        /* ==========================================
   AI Suggestions Page
========================================== */

        .content {
            padding: 30px;
            background: #f4f5fb;
            min-height: 100vh;
        }

        /* Header */
        /* .section-header01 {
            margin-bottom: 20px;
        }

        .section-header01 h2 {
            font-size: 40px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .section-header01 p {
            color: #7b7b90;
            font-size: 16px;
        } */

        /* Cards */
        .panel {
            background: #fff;
            border: 1px solid #e8e8ef;
            border-radius: 18px;
            padding: 22px 24px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .05);
            transition: .25s;
        }

        .panel:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
        }

        /* Section Title */

        .section-title {
            display: flex;
            align-items: center;
            font-size: 27px;
            font-weight: 700;
            color: #2d3748;
        }

        .section-title i {
            margin-right: 10px;
        }

        /* Strength */

        .text-success {
            color: #1f8b4c !important;
        }

        /* Weakness */

        .text-danger {
            color: #dc3545 !important;
        }

        /* Brand Purple */

        .text-brand {
            color: #5b21d4;
        }

        /* Lists */

        .panel ul {
            padding-left: 28px;
            margin-top: 10px;
        }

        .panel li {
            font-size: 25px;
            margin-bottom: 1px;
            color: #303030;
        }

        .panel p {
            font-size: 23px;
            color: #555;
            margin: 0;
        }

        .subtle {
            color: #7d7d90;
        }

        /* Overall Rating */

        .rating-box {
            font-size: 35px;
            font-weight: 700;
            color: #5b21d4;
        }

        /* Cards spacing */

        .mb-3 {
            margin-bottom: 22px;
        }

        /* Equal height */

        .h-100 {
            height: 100%;
        }

        /* Responsive */

        @media(max-width:992px) {

            .section-header01 h2 {
                font-size: 30px;
            }

            .section-title {
                font-size: 21px;
            }

            .panel li,
            .panel p {
                font-size: 17px;
            }

        }

        @media(max-width:768px) {

            .content {
                padding: 18px;
            }

            .section-header01 h2 {
                font-size: 25px;
            }

            .section-header01 p {
                font-size: 14px;
            }

        }

        /* ===========================
   AI Suggestions Layout
=========================== */

.content{
    padding:30px;
    background:#f4f5fb;
    min-height:100vh;
}

/* Header */

/* .section-header01{
    margin-bottom:25px;
}

.section-header01 h2{
    font-size:38px;
    font-weight:700;
    color:#2f3542;
    margin-bottom:5px;
}

.section-header01 p{
    color:#80849a;
} */

/* ===========================
   GRID
=========================== */

.ai-grid{
    display:grid;
    grid-template-columns:repeat(2,minmax(0,1fr));
    gap:22px;
    align-items:stretch;
}

.full-width{
    grid-column:1 / -1;
}

/* ===========================
   PANELS
=========================== */

.panel{
    background:#fff;
    border:1px solid #ececf3;
    border-radius:18px;
    padding:24px;
    box-shadow:0 5px 18px rgba(0,0,0,.05);
    transition:.25s;
    height:100%;
}

.panel:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 28px rgba(0,0,0,.08);
}

.section-title{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:22px;
    font-weight:700;
    margin-bottom:18px;
}

.section-title i{
    font-size:22px;
}

.text-success{
    color:#198754;
}

.text-danger{
    color:#dc3545;
}

.text-brand{
    color:#5b21d4;
}

/* Overall */

.rating-box{
    font-size:52px;
    font-weight:700;
    color:#5b21d4;
}

.subtle{
    color:#7b8198;
}

/* Lists */

.panel ul{
    margin:0;
    padding-left:24px;
}

.panel li{
    margin-bottom:1px;
    font-size:18px;
}

.panel p{
    font-size:17px;
    line-height:1.7;
}

/* Responsive */

@media(max-width:900px){

    .ai-grid{
        grid-template-columns:1fr;
    }

    .full-width{
        grid-column:auto;
    }

}
    </style>

    {{-- Font Awesome (for the icons used below) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
                        AI Suggestions
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
                            <h2>AI Improvement Suggestions</h2>
                            <p>Automatically generated based on your evaluation data.</p>
                        </div>
                    </div>

                    @if (!$summary)
                        <div class="panel text-center py-5">
                            <p class="subtle mb-0">Not enough evaluation data yet to generate suggestions.</p>
                        </div>
                    @else
                        {{-- Overall rating --}}
                        <div class="panel mb-3">
                            <div class="section-title mb-2">
                                <i class="fa-solid fa-gauge-high text-brand"></i>
                                Overall Rating
                            </div>

                            <div class="rating-box">
                                {{ $summary['overall_rating'] !== null ? number_format($summary['overall_rating'], 2) : 'N/A' }}
                            </div>

                            <p class="subtle mt-2">
                                {{ $summary['overall_label'] }}
                            </p>
                        </div>

                        <div class="ai-grid">
                            {{-- Strengths --}}
                            <div class="col-lg-6">
                                <div class="panel h-100">
                                    <div class="section-title text-success mb-2">
                                        <i class="fa-solid fa-thumbs-up me-2"></i>Your Strengths
                                    </div>
                                    @if (empty($summary['strengths']))
                                        <p class="subtle">Keep collecting feedback — no standout strengths yet.</p>
                                    @else
                                        <ul class="mb-0">
                                            @foreach ($summary['strengths'] as $s)
                                                <li>{{ $s }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            {{-- Weaknesses --}}
                            <div class="col-lg-6">
                                <div class="panel h-100">
                                    <div class="section-title text-danger mb-2">
                                        <i class="fa-solid fa-triangle-exclamation me-2"></i>Areas to Improve
                                    </div>
                                    @if (empty($summary['weaknesses']))
                                        <p class="subtle">No significant weaknesses detected. Great work!</p>
                                    @else
                                        <ul class="mb-0">
                                            @foreach ($summary['weaknesses'] as $w)
                                                <li>{{ $w }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            {{-- Recommendations --}}
                            <div class="col-12">
                                <div class="panel">
                                    <div class="section-title text-brand mb-3">
                                        <i class="fa-solid fa-lightbulb"></i>
                                        Personalized Recommendations
                                    </div>
                                    <ul class="mb-0">
                                        @foreach ($summary['recommendations'] as $r)
                                            <li class="mb-1">{{ $r }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            {{-- Sentiment breakdown from comments --}}
                            <div class="col-12">
                                <div class="panel">
                                    <div class="section-title mb-2">
                                        <i class="fa-solid fa-comments me-2 text-brand"></i>Comment Sentiment
                                    </div>
                                    <p class="mb-2">
                                        Positive: {{ $summary['sentiment_counts']['positive'] }} &nbsp;|&nbsp;
                                        Neutral: {{ $summary['sentiment_counts']['neutral'] }} &nbsp;|&nbsp;
                                        Negative: {{ $summary['sentiment_counts']['negative'] }}
                                    </p>
                                    @if (!empty($summary['keywords']))
                                        <p class="subtle mb-0">
                                            Common keywords: {{ implode(', ', $summary['keywords']) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </main>

            </div>

        </div>

        <footer class="app-footer">
            <span id="footerText">
                &copy; {{ date('Y') }} Teacher Evaluation System
            </span>
        </footer>

    </div>

    @include('TeacherSide.javascript')

</body>

</html>