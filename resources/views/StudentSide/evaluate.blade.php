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

        
    </style>
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
                    <div class="page-header">
                        <h1>Evaluate Teacher</h1>
                        <p>Select a teacher-subject pairing to begin your evaluation.</p>
                    </div>

                    <div class="evaluation-grid">

                

                        @foreach ($evaluates as $evaluate )
                        <div class="evaluation-card">
                            <h3>{{ $evaluate->teacher->user->fname }} {{ $evaluate->teacher->user->lname }}</h3>
                            <p>{{ $evaluate->subject->code }} — {{ $evaluate->subject->name }} </p>
                            <span>{{ $evaluate->semester->name }} {{ $evaluate->semester->academicyear->year_label}}</span>
                            <button>Start Evaluation</button>
                        </div>
                        
                        @endforeach

                    </div>
                </main>
            </div>
        </div>
        @include('StudentSide.z-footer')
    </div>


    @include('StudentSide.javascript')
</body>

</html>