<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Logs</title>
    @include('AdminSide.css')

    <style>
        .al-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .al-table-wrapper {
            overflow-x: auto;
        }

        .al-table {
            width: 100%;
            border-collapse: collapse;
        }

        .al-table th {
            background: #f3f2fb;
            color: #4b3cc9;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.03em;
            text-align: left;
            padding: 12px;
        }

        .al-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #1a1a2e;
        }

        .al-table tr:hover td {
            background: #fafafa;
        }

        .al-role {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .al-role.role-Admin {
            background: #ede9fe;
            color: #6d28d9;
        }

        .al-role.role-Teacher {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .al-role.role-Student {
            background: #dcfce7;
            color: #15803d;
        }

        .al-no-data {
            padding: 30px;
            text-align: center;
            color: #888;
            font-style: italic;
        }
    </style>
</head>

<body style="height:100%;margin:0">
    <div class="app-wrapper">
        <div class="app-body">
            @include('AdminSide.dashboard')

            <div class="main-area">
                <header class="top-bar"><button class="mobile-menu-btn" id="mobileMenuBtn"
                        aria-label="Toggle menu">☰</button><span class="top-bar-title">Admin Side</span>
                    <div class="avatar" id="avatarToggle">
                        {{ substr(Auth::user()->fname ?? '', 0, 1) }}
                        {{ substr(Auth::user()->lname ?? '', 0, 1) }}
                    </div>

                    <div class="nav-dropdown" id="navDropdown">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">Logout</button>
                        </form>
                    </div>
                </header>

                <main class="content">
                    @if(session('success'))
                        <div class="success-msg">{{ session('success') }}</div>
                    @endif

                    <div class="section-header01">
                        <div class="section-title01">
                            <h2>Audit Logs</h2>
                            <p>System activity history for all users.</p>
                        </div>
                    </div>

                    <div class="al-card">
                        <div class="al-table-wrapper">
                            <table class="al-table">
                                <thead>
                                    <tr>
                                        <th>Date &amp; Time</th>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($auditLogs as $log)
                                        <tr>
                                            <td>{{ $log->created_at->format('M d, Y h:i A') }}</td>
                                            <td>
                                                {{ $log->user
                                                    ? trim($log->user->fname.' '.$log->user->lname)
                                                    : 'Deleted user' }}
                                            </td>
                                            <td>
                                                @if($log->user)
                                                    <span class="al-role role-{{ $log->user->userType }}">
                                                        {{ $log->user->userType }}
                                                    </span>
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>{{ $log->action }}</td>
                                            <td>{{ $log->details }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="al-no-data">No audit logs found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div style="margin-top:16px">
                            {{ $auditLogs->links() }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <footer class="app-footer"><span id="footerText">© 2025 Lance Levi Java. All rights reserved.</span></footer>
    </div>

    @include('AdminSide.javascript')
</body>

</html>