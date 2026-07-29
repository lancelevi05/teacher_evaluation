<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('StudentSide.css')
    <style>
        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 34px;
            font-weight: 700;
            color: #222;
        }

        .page-header p {
            margin-top: 8px;
            color: #6b7280;
            font-size: 16px;
        }

        .evaluation-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .evaluation-card {
            background: #fff;
            border: 1px solid #e8e8e8;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .05);
            transition: .25s;
        }

        .evaluation-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
        }

        .evaluation-card h3 {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            color: #2d2d2d;
        }

        .evaluation-card p {
            margin: 14px 0 10px;
            color: #5f6470;
            font-size: 18px;
        }

        .evaluation-card span {
            display: block;
            margin-bottom: 22px;
            color: #7b8190;
            font-size: 16px;
        }

        .evaluation-card button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #5b21b6;
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .evaluation-card button:hover {
            background: #4c1d95;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 34px;
            font-weight: 700;
            color: #222;
        }

        .page-header p {
            margin-top: 8px;
            color: #6b7280;
            font-size: 16px;
        }

        /* ---- Evaluation form cards ---- */
        .eval-panel {
            background: #fff;
            border: 1px solid #e8e8e8;
            border-radius: 16px;
            padding: 24px 28px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .04);
            margin-bottom: 24px;
        }

        .eval-panel .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 18px;
        }

        .question-block {
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 18px 20px;
            margin-bottom: 16px;
        }

        .question-block:last-child {
            margin-bottom: 0;
        }

        .question-block label.form-label {
            font-size: 16px;
            font-weight: 600;
            color: #2d2d2d;
            margin-bottom: 10px;
            display: block;
        }

        .question-block textarea {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 15px;
            resize: vertical;
        }

        /* ---- Star rating ---- */
        .star-rating {
            display: flex;
            gap: 10px;
        }

        .star-rating .star {
            font-size: 26px;
            color: #d9d9df;
            cursor: pointer;
            transition: color .15s, transform .1s;
            user-select: none;
        }

        .star-rating .star:hover,
        .star-rating .star.hovered {
            transform: scale(1.08);
        }

        .star-rating .star.active {
            color: #f5a623;
        }

        /* ---- Anonymous mode toggle ---- */
        .anon-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .anon-toggle .anon-label {
            font-size: 17px;
            font-weight: 700;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .anon-toggle .anon-sub {
            color: #6b7280;
            font-size: 14px;
            margin: 4px 0 0;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 28px;
            flex-shrink: 0;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .switch .slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background-color: #d1d5db;
            border-radius: 34px;
            transition: .2s;
        }

        .switch .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 3px;
            bottom: 3px;
            background-color: #fff;
            border-radius: 50%;
            transition: .2s;
        }

        .switch input:checked+.slider {
            background-color: #5b21b6;
        }

        .switch input:checked+.slider:before {
            transform: translateX(24px);
        }

        /* ---- Buttons ---- */
        .btn-brand {
            background: #5b21b6;
            color: #fff;
            border: none;
            padding: 12px 26px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: .2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-brand:hover {
            background: #4c1d95;
            color: #fff;
        }

        .btn-light {
            background: #f3f4f6;
            color: #374151;
            border: none;
            padding: 12px 26px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
    </style>
    <script>
        function initStarRating(containerId, inputId, initialValue = 0) {
            const container = document.getElementById(containerId);
            const input = document.getElementById(inputId);
            if (!container || !input) return;

            const stars = container.querySelectorAll('.star');

            function paint(value) {
                stars.forEach(star => {
                    const val = parseInt(star.dataset.value, 10);
                    star.classList.toggle('active', val <= value);
                });
            }

            stars.forEach(star => {
                star.addEventListener('mouseenter', () => paint(parseInt(star.dataset.value, 10)));
                star.addEventListener('click', () => {
                    input.value = star.dataset.value;
                    paint(parseInt(star.dataset.value, 10));
                });
            });

            container.addEventListener('mouseleave', () => paint(parseInt(input.value || 0, 10)));

            paint(initialValue);
        }
        document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.star-rating').forEach(container => {
        const input = document.getElementById(container.dataset.input);
        if (!input) return;

        const stars = container.querySelectorAll('.star');

        function paint(value) {
            stars.forEach(star => {
                star.classList.toggle('active', parseInt(star.dataset.value, 10) <= value);
            });
        }

        stars.forEach(star => {
            star.addEventListener('mouseenter', () => paint(parseInt(star.dataset.value, 10)));
            star.addEventListener('click', () => {
                input.value = star.dataset.value;
                paint(parseInt(star.dataset.value, 10));
            });
        });

        container.addEventListener('mouseleave', () => paint(parseInt(input.value || 0, 10)));
    });
});
    </script>
</head>

<body style="height:100%;margin:0">
    <div class="app-wrapper">
        <div class="app-body">
            <!-- Sidebar -->
            @include('StudentSide.dashboard')
            <!-- Sidebar -->

            <!-- Main Content -->
            <div class="main-area">
                <header class="top-bar"><button class="mobile-menu-btn" id="mobileMenuBtn"
                        aria-label="Toggle menu">☰</button><span class="top-bar-title">Student Side</span>
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
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(!empty($noProfile))
                        <div class="page-header text-center">
                            <p>Your student profile is not yet set up. Please contact the administrator.</p>
                        </div>

                    @elseif(empty($selectedAssignment))
                        <div class="page-header">
                            <h1>Evaluate Teacher</h1>
                            <p>Select a teacher-subject pairing to begin your evaluation.</p>
                        </div>

                        @if($evaluates->isEmpty())
                            <p>You're all caught up! No pending evaluations right now.</p>
                        @else
                            <div class="evaluation-grid">
                                @foreach ($evaluates as $evaluate)
                                    <div class="evaluation-card">
                                        <h3>{{ $evaluate->teacher->user->fname }} {{ $evaluate->teacher->user->lname }}</h3>
                                        <p>{{ $evaluate->subject->code }} — {{ $evaluate->subject->name }}</p>
                                        <span>{{ $evaluate->semester->name }}
                                            {{ $evaluate->semester->academicyear->year_label }}</span>
                                        <a href="{{ route('student.evaluate', ['assignment_id' => $evaluate->id]) }}">
                                            <button type="button">Start Evaluation</button>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    @else
                        <div class="page-header">
                            <a href="{{ route('student.evaluate') }}">&larr; Back to list</a>
                            <h1>Evaluating: {{ $selectedAssignment->teacher->user->fname }}
                                {{ $selectedAssignment->teacher->user->lname }}</h1>
                            <p>
                                {{ $selectedAssignment->subject->code }} — {{ $selectedAssignment->subject->name }} ·
                                {{ $selectedAssignment->semester->name }}
                                {{ $selectedAssignment->semester->academicyear->year_label }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('student.evaluate.store') }}" id="evalForm">
                            @csrf
                            <input type="hidden" name="assignment_id" value="{{ $selectedAssignment->id }}">

                            <div class="eval-panel anon-toggle">
                                <div>
                                    <div class="anon-label"><i class="fa-solid fa-user-secret"></i> Anonymous Mode</div>
                                    <p class="anon-sub">Your identity will not be shown to the teacher.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="anonymous" id="anonToggle" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>

                            @foreach ($categories as $group)
                                <div class="eval-panel">
                                    <div class="section-title">{{ $group->name }}</div>

                                    @foreach ($group->questions as $q)
                                        <div class="question-block">
                                            <label class="form-label">{{ $q->question_text }}</label>

                                            @if($q->type === 'text')
                                                <textarea name="q_{{ $q->id }}" rows="2" placeholder="Optional comment..."></textarea>

                                            @elseif($q->type === 'yes_no')
                                                <div class="d-flex gap-3 mt-1">
                                                    <label><input type="radio" name="q_{{ $q->id }}" value="5" required> Yes</label>
                                                    <label><input type="radio" name="q_{{ $q->id }}" value="1"> No</label>
                                                </div>

                                            @else
                                               <div class="star-rating" id="stars_{{ $q->id }}" data-input="input_{{ $q->id }}">
    @for ($i = 1; $i <= 5; $i++)
        <span class="star" data-value="{{ $i }}"><i class="fa-solid fa-star"></i></span>
    @endfor
</div>
<input type="hidden" name="q_{{ $q->id }}" id="input_{{ $q->id }}" required>
                                                <script>initStarRating('stars_{{ $q->id }}', 'input_{{ $q->id }}', 0);</script>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-end gap-2 mb-4">
                                <a href="{{ route('student.evaluate') }}" class="btn-light">Cancel</a>
                                <button type="submit" class="btn-brand">Submit Evaluation</button>
                            </div>
                        </form>

                        <script>
                            document.getElementById('evalForm').addEventListener('submit', function (e) {
                                const hiddenStars = this.querySelectorAll('input[type=hidden][id^=input_]');
                                for (const inp of hiddenStars) {
                                    if (!inp.value) {
                                        e.preventDefault();
                                        alert('Please rate all questions before submitting.');
                                        return;
                                    }
                                }
                            });
                        </script>
                    @endif
                </main>
            </div>
        </div>
        @include('StudentSide.z-footer')
    </div>


    @include('StudentSide.javascript')
    
</body>

</html>