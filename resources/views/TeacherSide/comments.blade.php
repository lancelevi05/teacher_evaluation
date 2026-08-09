<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>

    @include('StudentSide.css')
    <style>
    /* Student Comments — panel styling */
    .panel {
        background: #ffffff;
        border-radius: 14px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .panel .question-block {
        background: #fafbfc;
        border: 1px solid #eef0f3;
        border-radius: 12px;
        padding: 1.1rem 1.3rem;
        margin-bottom: 1rem;
        transition: box-shadow 0.2s ease, transform 0.2s ease, border-color 0.2s ease;
    }

    .panel .question-block:last-child {
        margin-bottom: 0;
    }

    .panel .question-block:hover {
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        border-color: #e2e5ea;
        transform: translateY(-1px);
    }

    .panel .question-block p {
        font-size: 0.97rem;
        line-height: 1.55;
        color: #333;
        font-style: italic;
    }

    .panel .subtle {
        color: #8a8f98;
    }

    .panel .subtle.small {
        font-size: 0.82rem;
        font-weight: 500;
    }

    /* Sentiment badges */
    .panel .badge {
        font-size: 0.78rem;
        font-weight: 600;
        padding: 0.4rem 0.75rem;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        letter-spacing: 0.2px;
    }

    .panel .badge-soft-success {
        background: #e6f7ed;
        color: #1e8a4c;
    }

    .panel .badge-soft-danger {
        background: #fdeaea;
        color: #d64545;
    }

    .panel .badge-soft-secondary {
        background: #eef0f3;
        color: #6b7280;
    }

    .panel .badge i {
        font-size: 0.75rem;
    }

    /* Empty state */
    .panel .text-center.py-4 {
        color: #9aa0a8;
        font-size: 0.95rem;
    }

    /* Responsive tweak */
    @media (max-width: 576px) {
        .panel .question-block {
            padding: 0.9rem 1rem;
        }

        .panel .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 0.4rem;
        }
    }
</style>

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
            <h2>Student Comments</h2>
            <p>Anonymous feedback left by your students.</p>
        </div>
    </div>

    <div class="panel">
        @if ($comments->isEmpty())
            <p class="subtle text-center py-4 mb-0">No comments yet.</p>
        @else
            @foreach ($comments as $c)
                @php
                    $badgeClass = match ($c->sentiment) {
                        'positive' => 'success',
                        'negative' => 'danger',
                        default => 'secondary',
                    };
                    $icon = match ($c->sentiment) {
                        'positive' => 'face-smile',
                        'negative' => 'face-frown',
                        default => 'face-meh',
                    };
                @endphp
                <div class="question-block">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge badge-soft-{{ $badgeClass }}">
                            <i class="fa-solid fa-{{ $icon }} me-1"></i>
                            {{ ucfirst($c->sentiment) }}
                        </span>
                        <span class="subtle small">{{ $c->subject_name }} · {{ \Carbon\Carbon::parse($c->created_at)->format('M j, Y') }}</span>
                    </div>
                    <p class="mb-0">"{{ $c->answer_text }}"</p>
                </div>
            @endforeach
        @endif
    </div>
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