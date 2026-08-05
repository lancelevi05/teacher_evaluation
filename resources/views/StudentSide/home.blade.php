<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('StudentSide.css')
    <style>
        .alert-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: linear-gradient(135deg, #fff8e8 0%, #fff3d6 100%);
            border: 1px solid #f5deA0;
            border-left: 5px solid #d97706;
            border-radius: 12px;
            padding: 20px 24px;
            margin: 20px 0;
        }

        .alert-banner-content {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .alert-banner-icon {
            flex-shrink: 0;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fef3c7;
            color: #d97706;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .alert-banner-text strong {
            display: block;
            font-size: 15px;
            color: #7a4a00;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .alert-banner-text p {
            margin: 0;
            font-size: 13px;
            color: #92700f;
        }

        .alert-banner-btn {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #d97706;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            white-space: nowrap;
            transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
        }

        .alert-banner-btn:hover {
            background: #b45f04;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(217, 119, 6, 0.3);
        }

        @media (max-width: 576px) {
            .alert-banner {
                flex-direction: column;
                align-items: stretch;
                text-align: left;
            }

            .alert-banner-btn {
                justify-content: center;
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
                    <div class="welcome-card">
                        <h1 id="welcomeHeading">Welcome back,
                            {{ Auth::user()->fname }}
                        </h1>
                        <p id="welcomeText">Your voice helps improve teaching quality. Thank you for participating.

                        </p>
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
                            <div class="stat-label">Pending Evaluations</div>
                            <div class="stat-value">{{ $pending }}</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Completed Evaluations</div>
                            <div class="stat-value">{{ $completed }}</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Anonymous &amp; Secure</div>
                            <div class="stat-value">100%</div>
                        </div>
                    </div>

                    @if($pending > 0)
                        <div class="alert-banner">
                            <div class="alert-banner-content">
                                <div class="alert-banner-icon">⏳</div>
                                <div class="alert-banner-text">
                                    <strong>You have {{ $pending }} evaluation{{ $pending > 1 ? 's' : '' }} waiting</strong>
                                    <p>Complete them before the semester ends.</p>
                                </div>
                            </div>
                            <a href="{{ route('student.evaluate') }}" class="alert-banner-btn">
                                Evaluate Now →
                            </a>
                        </div>
                    @endif

                    <section class="section-card">
                        <h2>Recent Evaluations</h2>
                        @if($recent->isEmpty())
                            <p>You haven't submitted any evaluations yet.</p>
                        @else
                            <table class="sections-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Teacher</th>
                                        <th>Subject</th>
                                        <th>Rating</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent as $r)
                                        <tr>
                                            <td>{{ $r->teacher_name }}</td>
                                            <td>{{ $r->subject_name }}</td>
                                            <td><span class="rating-badge {{ $r->rating_class }}">
                                                    {{ number_format($r->overall_rating, 2) }}
                                                </span></td>
                                            <td>{{ \Carbon\Carbon::parse($r->created_at)->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </section>
                </main>
            </div>
        </div>
        @include('StudentSide.z-footer')
    </div>


    @include('StudentSide.javascript')
</body>

</html>