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
                            <h2>Evaluation History</h2>
                            <p>All evaluations you have submitted.</p>
                        </div>



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