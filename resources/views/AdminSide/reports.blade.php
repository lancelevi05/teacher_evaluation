<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('AdminSide.css')


    <style>
        /* ===== SECTIONS PAGE ===== */

        .sections-container {
            display: flex;
            gap: 20px;
            padding: 20px;
            height: 100%;
        }

        /* Cards */
        .card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        /* TABLE AREA takes more space */
        .table-card {
            flex: 2;
            display: flex;
            flex-direction: column;
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto;
        }

        .sections-table {
            width: 100%;
            border-collapse: collapse;
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

        .sections-table tr:hover {
            background: #fafafa;
        }

        /* No Data */
        .no-data {
            padding: 30px;
            text-align: center;
            color: #888;
            font-style: italic;
        }

        .success-msg {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .student-name {
            font-size: 15px;
            font-weight: 600;
            color: #222;
            line-height: 1.3;
        }

        .student-subtitle {
            font-size: 13px;
            color: #7a7a7a;
            margin-top: 2px;
        }

        /* ===== PERFORMANCE BADGE ===== */
        .performance-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            white-space: nowrap;
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
            background: #f1f2f6;
            color: #7a7a7a;
        }

        /* ===== Reports Header ===== */
        .section-header01 {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 20px;
        }

        .section-title01 {
            flex: 1;
        }

        .section-title01 p {
            margin-bottom: 14px;
        }

        /* Tabs */
        .report-tabs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .report-tab {
            padding: 10px 18px;
            border: 1px solid #d9d9d9;
            border-radius: 8px;
            background: #fff;
            color: #444;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: .2s;
            text-decoration: none;
            display: inline-block;
        }

        .report-tab:hover,
        .report-tab.active {
            background: #4b3cc9;
            color: #fff;
            border-color: #4b3cc9;
        }

        /* Print Button */
        .print-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 11px 18px;
            border: none;
            border-radius: 8px;
            background: #16a34a;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .print-btn:hover {
            background: #15803d;
        }

        .print-btn .material-symbols-rounded {
            font-size: 20px;
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {

            .section-header01 {
                flex-direction: column;
                align-items: stretch;
            }

            .report-tabs {
                width: 100%;
            }

            .report-tab {
                flex: 1;
                min-width: 120px;
                text-align: center;
            }

            .print-btn {
                align-self: flex-end;
            }
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
                            <h2>Reports</h2>
                            <p>Printable summaries by teacher, department, and semester.</p>

                            <div class="report-tabs">
                                <a href="{{ url()->current() }}?type=teacher"
                                    class="report-tab {{ $type === 'teacher' ? 'active' : '' }}">Teacher</a>
                                <a href="{{ url()->current() }}?type=department"
                                    class="report-tab {{ $type === 'department' ? 'active' : '' }}">Department</a>
                                <a href="{{ url()->current() }}?type=semester"
                                    class="report-tab {{ $type === 'semester' ? 'active' : '' }}">Semester</a>
                            </div>
                        </div>

                        <button class="print-btn" onclick="window.print()" type="button">
                            <span class="material-symbols-rounded">print</span>
                            Print
                        </button>

                    </div>

                    <div class="sections-container">

                        <!-- TABLE -->
                        <div class="card table-card">

                            @if(session('success'))
                                <div class="success-msg">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- ===================== TEACHER REPORT ===================== --}}
                            @if($type === 'teacher')
                                @if($teacherInfo->isEmpty())
                                    <div class="no-data">No data existed.</div>
                                @else
                                    <div class="table-wrapper">
                                        <table class="sections-table">
                                            <thead>
                                                <tr>
                                                    <th>TEACHER</th>
                                                    <th>DEPARTMENT</th>
                                                    <th>EVALUATIONS</th>
                                                    <th>AVR RATING</th>
                                                    <th>PERFORMANCE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($teacherInfo as $row)
                                                    <tr>
                                                        <td>
                                                            <div class="student-name">
                                                                {{ $row->lname }}, {{ $row->fname }}
                                                            </div>
                                                            <div class="student-subtitle">
                                                                {{ $row->employee_id }}
                                                            </div>
                                                        </td>
                                                        <td>{{ $row->department_name ?? '-' }}</td>
                                                        <td>{{ $row->evaluations_count ?? 0 }}</td>
                                                        <td>{{ $row->rating ?? '--' }}</td>
                                                        <td>
                                                            <span class="performance-badge {{ $row->perf_class }}">
                                                                {{ $row->perf_label }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                            {{-- ===================== DEPARTMENT REPORT ===================== --}}
                            @elseif($type === 'department')
                                @if($departmentReport->isEmpty())
                                    <div class="no-data">No data existed.</div>
                                @else
                                    <div class="table-wrapper">
                                        <table class="sections-table">
                                            <thead>
                                                <tr>
                                                    <th>DEPARTMENT</th>
                                                    <th>TEACHERS</th>
                                                    <th>EVALUATIONS</th>
                                                    <th>AVR RATING</th>
                                                    <th>PERFORMANCE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($departmentReport as $row)
                                                    <tr>
                                                        <td class="student-name">{{ $row->name }}</td>
                                                        <td>{{ $row->teacher_count }}</td>
                                                        <td>{{ $row->evaluations_count ?? 0 }}</td>
                                                        <td>{{ $row->rating ?? '--' }}</td>
                                                        <td>
                                                            <span class="performance-badge {{ $row->perf_class }}">
                                                                {{ $row->perf_label }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                            {{-- ===================== SEMESTER REPORT ===================== --}}
                            @else
                                @if($semesterReport->isEmpty())
                                    <div class="no-data">No data existed.</div>
                                @else
                                    <div class="table-wrapper">
                                        <table class="sections-table">
                                            <thead>
                                                <tr>
                                                    <th>SEMESTER</th>
                                                    <th>ACADEMIC YEAR</th>
                                                    <th>EVALUATIONS</th>
                                                    <th>AVR RATING</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($semesterReport as $row)
                                                    <tr>
                                                        <td class="student-name">{{ $row->semester_name }}</td>
                                                        <td>{{ $row->year_label }}</td>
                                                        <td>{{ $row->evaluations_count ?? 0 }}</td>
                                                        <td>{{ $row->rating ?? '--' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endif

                        </div>

                    </div>
                </main>
            </div>
        </div>
        <footer class="app-footer"><span id="footerText">© 2025 Lance Levi Java. All rights reserved.</span>
        </footer>
    </div>

    @include('AdminSide.javascript')

</body>

</html>