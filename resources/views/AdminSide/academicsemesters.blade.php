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

        /* FORM AREA takes remaining */
        .form-card {
            flex: 1;
            min-width: 280px;
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
            background: #f5f6fa;
            padding: 12px;
            text-align: left;
        }

        .sections-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
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

        /* Form */
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            background: #2c7be5;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #1a68d1;
        }

        /* ===== MOBILE RESPONSIVE ===== */
        @media(max-width:900px) {

            .sections-container {
                flex-direction: column;
            }

            .form-card {
                width: 100%;
            }
        }

        .select-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            background: white;
        }

        /* ===================================================== */
        /* ===== ACADEMIC YEARS & SEMESTERS (02 namespace) ===== */
        /* ===================================================== */

        .ay-container02 {
            display: flex;
            gap: 20px;
            padding: 20px;
            flex-wrap: wrap;
        }

        .ay-card02 {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            flex: 1;
            min-width: 320px;
            display: flex;
            flex-direction: column;
        }

        .ay-card-header02 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .ay-card-header02 h3 {
            margin: 0;
            font-size: 18px;
            color: #1a1a2e;
        }

        .ay-btn-add02 {
            background: #4b3cc9;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .ay-btn-add02:hover {
            background: #3c2fa8;
        }

        .btn-archive {
            background: #f59e0b;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 6px 14px;
            cursor: pointer;
        }

        .btn-archive:hover {
            background: #d97706;
        }

        .btn-close-semester {
            background: #ef4444;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 6px 14px;
            cursor: pointer;
        }

        .btn-close-semester:hover {
            background: #dc2626;
        }

        .btn-activate {
            background: #22c55e;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 6px 14px;
            cursor: pointer;
        }

        .btn-activate:hover {
            background: #16a34a;
        }

        .ay-table-wrapper02 {
            overflow-x: auto;
        }

        .ay-table02 {
            width: 100%;
            border-collapse: collapse;
        }

        .ay-table02 th {
            background: #f3f2fb;
            color: #4b3cc9;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.03em;
            text-align: left;
            padding: 12px;
        }

        .ay-table02 td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #1a1a2e;
        }

        .ay-table02 tr:last-child td {
            border-bottom: none;
        }

        .ay-table02 tr:hover td {
            background: #fafafa;
        }

        /* .ay-status02 {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
        }

        .ay-status02.is-active02 {
            background: #e3f9ec;
            color: #1c9a5b;
        }

        .ay-status02.is-inactive02 {
            background: rgb(158, 158, 158);
            color: #888;
        } */

        .ay-status02 {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .ay-status02.is-active02 {
            background: #dcfce7;
            color: #15803d;
        }

        .ay-status02.is-archived02 {
            background: #fee2e2;
            color: #b91c1c;
        }

        .ay-btn-action02 {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 6px 14px;
            font-size: 13px;
            cursor: pointer;
        }

        .ay-btn-action02:hover {
            background: #f5f6fa;
        }

        .ay-no-data02 {
            padding: 30px;
            text-align: center;
            color: #888;
            font-style: italic;
        }

        @media(max-width:900px) {
            .ay-container02 {
                flex-direction: column;
            }
        }

        /* ===== ADD SEMESTER MODAL (02 namespace) ===== */

        .ay-modal-overlay02 {
            position: fixed;
            inset: 0;
            background: rgba(20, 20, 30, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0s linear 0.25s;
        }

        .ay-modal-overlay02.is-open02 {
            opacity: 1;
            visibility: visible;
            transition: opacity 0.25s ease, visibility 0s linear 0s;
        }

        .ay-modal02 {
            background: #fff;
            border-radius: 10px;
            width: 100%;
            max-width: 450px;
            margin: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            transform: translateY(-16px) scale(0.97);
            opacity: 0;
            transition: transform 0.28s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.22s ease;
        }

        .ay-modal-overlay02.is-open02 .ay-modal02 {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        .ay-modal-header02 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            border-bottom: 1px solid #eee;
        }

        .ay-modal-header02 h3 {
            margin: 0;
            font-size: 19px;
            color: #1a1a2e;
        }

        .ay-modal-close02 {
            background: none;
            border: none;
            font-size: 20px;
            line-height: 1;
            color: #888;
            cursor: pointer;
            padding: 4px;
        }

        .ay-modal-close02:hover {
            color: #333;
        }

        .ay-modal-body02 {
            padding: 20px 24px;
        }

        .ay-form-group02 {
            display: flex;
            flex-direction: column;
            margin-bottom: 16px;
        }

        .ay-form-group02:last-child {
            margin-bottom: 0;
        }

        .ay-form-group02 label {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        .ay-select02 {
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            background: #fff;
            font-size: 14px;
            color: #1a1a2e;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23555' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            padding-right: 34px;
        }

        .ay-select02:focus {
            outline: none;
            border-color: #4b3cc9;
        }

        .ay-input02 {
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            font-size: 14px;
            color: #1a1a2e;
        }

        .ay-input02:focus {
            outline: none;
            border-color: #4b3cc9;
        }

        .ay-modal-footer02 {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 24px;
            border-top: 1px solid #eee;
        }

        .ay-btn-cancel02 {
            background: #f1f1f4;
            color: #333;
            border: none;
            border-radius: 6px;
            padding: 9px 18px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .ay-btn-cancel02:hover {
            background: #e4e4e9;
        }

        .ay-btn-save02 {
            background: #4b3cc9;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 9px 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .ay-btn-save02:hover {
            background: #3c2fa8;
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

                    @if(session('success'))
                        <div class="success-msg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="error-msg">
                            @foreach($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <div class="section-header01">

                        <div class="section-title01">
                            <h2>Academic Years & Semesters</h2>
                            <p>Manage the academic calendar used across evaluations.</p>

                        </div>


                    </div>



                    <div class="ay-container02">




                        {{-- ===== ACADEMIC YEARS CARD ===== --}}
                        <div class="ay-card02" id="academicYearsCard02">
                            <div class="ay-card-header02">
                                <h3>Academic Years</h3>
                                <button type="button" class="ay-btn-add02" id="addAcademicYearBtn02">
                                    + Add
                                </button>
                            </div>

                            <div class="ay-table-wrapper02">

                                <table class="ay-table02" id="academicYearsTable02">
                                    <thead>
                                        <tr>
                                            <th>Year</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($academicYears as $ay02)
                                            <tr>
                                                <td>{{ $ay02->year_label }}</td>
                                                <td>
                                                    <span
                                                        class="ay-status02 {{ $ay02->status == 'active' ? 'is-active02' : 'is-archived02' }}">
                                                        {{ ucfirst($ay02->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- <button class="ay-btn-action02">
                                                                    Archive
                                                                </button> -->

                                                    @if($ay02->status == 'active')
                                                        <button class="btn-archive">
                                                            Archive
                                                        </button>
                                                    @else
                                                        <button class="btn-activate">
                                                            Activate
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="ay-no-data02">
                                                    No academic years found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- ===== SEMESTERS CARD ===== --}}
                        <div class="ay-card02" id="semestersCard02">
                            <div class="ay-card-header02">
                                <h3>Semesters</h3>
                                <button type="button" class="ay-btn-add02" id="addSemesterBtn02">
                                    + Add
                                </button>
                            </div>

                            <div class="ay-table-wrapper02">
                                <table class="ay-table02" id="semestersTable02">
                                    <thead>
                                        <tr>
                                            <th>Semester</th>
                                            <th>Academic Year</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($semesters as $sem02)
                                            <tr>
                                                <td><strong>{{ $sem02->name }}</strong></td>
                                                <td>
                                                    @php
                                                        $info = $academicYears->firstWhere('id', $sem02->academic_year_id);
                                                    @endphp
                                                    {{ $info ? $info->year_label : '--' }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="ay-status02 {{ $sem02->status == 'active' ? 'is-active02' : 'is-archived02' }}">
                                                        {{ ucfirst($sem02->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- <button class="ay-btn-action02">
                                                                    Close
                                                                </button> -->

                                                    @if($sem02->status == 'active')
                                                        <form method="POST" action="{{ route('semester.close', $sem02->id) }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <button type="submit" class="btn-close-semester">
                                                                Close
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('semester.change_open', $sem02->id) }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <button type="submit" class="btn-activate">
                                                                Activate
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="ay-no-data02">
                                                    No semesters found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    {{-- ===== ADD ACADEMIC YEAR MODAL ===== --}}
                    <div class="ay-modal-overlay02" id="academicYearModalOverlay02">
                        <div class="ay-modal02" role="dialog" aria-modal="true"
                            aria-labelledby="academicYearModalTitle02">
                            <div class="ay-modal-header02">
                                <h3 id="academicYearModalTitle02">Add Academic Year</h3>
                                <button type="button" class="ay-modal-close02" id="closeAcademicYearModalBtn02"
                                    aria-label="Close">&times;</button>
                            </div>

                            <form id="academicYearForm02" method="POST" action="{{ route('academic.store') }}">
                                @csrf
                                <div class="ay-modal-body02">
                                    <div class="ay-form-group02">
                                        <label for="academicYear02">Academic Year</label>
                                        <input type="text" class="ay-input02" id="academicYear02" name="academic_year"
                                            placeholder="2026-2027" required>
                                    </div>


                                    <!-- <div class="ay-form-group02">
                                        <label for="academicYearStatus02">Status</label>
                                        <select class="ay-select02" id="academicYearStatus02" name="status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div> -->
                                </div>

                                <div class="ay-modal-footer02">
                                    <button type="button" class="ay-btn-cancel02"
                                        id="cancelAcademicYearBtn02">Cancel</button>
                                    <button type="submit" class="ay-btn-save02" id="saveAcademicYearBtn02">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- ===== ADD SEMESTER MODAL ===== --}}
                    <div class="ay-modal-overlay02" id="semesterModalOverlay02">
                        <div class="ay-modal02" role="dialog" aria-modal="true" aria-labelledby="semesterModalTitle02">
                            <div class="ay-modal-header02">
                                <h3 id="semesterModalTitle02">Add Semester</h3>
                                <button type="button" class="ay-modal-close02" id="closeSemesterModalBtn02"
                                    aria-label="Close">&times;</button>
                            </div>

                            <form id="semesterForm02" method="POST" action="{{ route('semester.store') }}">
                                @csrf
                                <div class="ay-modal-body02">
                                    <div class="ay-form-group02">
                                        <label for="semesterAcademicYear02">Academic Year</label>
                                        <select class="ay-select02" id="semesterAcademicYear02" name="academic_year_id">
                                            @foreach ($academicYears as $ay02)
                                                <option value="{{ $ay02['id'] }}">{{ $ay02['year_label'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="ay-form-group02">
                                        <label for="semesterName02">Semester</label>
                                        <select class="ay-select02" id="semesterName02" name="name">
                                            <option value="First Semester">First Semester</option>
                                            <option value="Second Semester">Second Semester</option>
                                            <option value="Summer">Summer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="ay-modal-footer02">
                                    <button type="button" class="ay-btn-cancel02"
                                        id="cancelSemesterBtn02">Cancel</button>
                                    <button type="submit" class="ay-btn-save02" id="saveSemesterBtn02">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <footer class="app-footer"><span id="footerText">© 2025 Lance Levi Java. All rights reserved.</span>
        </footer>
    </div>

    <script>
        // ===== ACADEMIC YEARS & SEMESTERS (02 namespace) =====
        // These are wired to the mock data above for now.
        // Swap the console.log lines for real fetch()/form submissions once endpoints exist.

        // ----- Add Academic Year modal (smooth open/close) -----
        const academicYearModalOverlay02 = document.getElementById('academicYearModalOverlay02');
        const academicYearForm02 = document.getElementById('academicYearForm02');

        function openAcademicYearModal02() {
            academicYearModalOverlay02.style.display = 'flex';
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    academicYearModalOverlay02.classList.add('is-open02');
                });
            });
            document.body.style.overflow = 'hidden';
        }

        function closeAcademicYearModal02() {
            academicYearModalOverlay02.classList.remove('is-open02');
            document.body.style.overflow = '';
            setTimeout(() => {
                if (!academicYearModalOverlay02.classList.contains('is-open02')) {
                    academicYearModalOverlay02.style.display = 'none';
                }
            }, 250);
        }

        document.getElementById('addAcademicYearBtn02')?.addEventListener('click', openAcademicYearModal02);
        document.getElementById('closeAcademicYearModalBtn02')?.addEventListener('click', closeAcademicYearModal02);
        document.getElementById('cancelAcademicYearBtn02')?.addEventListener('click', closeAcademicYearModal02);

        academicYearModalOverlay02?.addEventListener('click', function (e) {
            if (e.target === academicYearModalOverlay02) {
                closeAcademicYearModal02();
            }
        });



        // ----- Add Semester modal (smooth open/close) -----
        const semesterModalOverlay02 = document.getElementById('semesterModalOverlay02');
        const semesterForm02 = document.getElementById('semesterForm02');

        function openSemesterModal02() {
            semesterModalOverlay02.style.display = 'flex';
            // Force a reflow so the transition actually plays, then add the open class
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    semesterModalOverlay02.classList.add('is-open02');
                });
            });
            document.body.style.overflow = 'hidden';
        }

        function closeSemesterModal02() {
            semesterModalOverlay02.classList.remove('is-open02');
            document.body.style.overflow = '';
            // Wait for the CSS transition to finish before hiding it
            setTimeout(() => {
                if (!semesterModalOverlay02.classList.contains('is-open02')) {
                    semesterModalOverlay02.style.display = 'none';
                }
            }, 250);
        }

        document.getElementById('addSemesterBtn02')?.addEventListener('click', openSemesterModal02);
        document.getElementById('closeSemesterModalBtn02')?.addEventListener('click', closeSemesterModal02);
        document.getElementById('cancelSemesterBtn02')?.addEventListener('click', closeSemesterModal02);

        // Close when clicking the dark backdrop (but not the dialog itself)
        semesterModalOverlay02?.addEventListener('click', function (e) {
            if (e.target === semesterModalOverlay02) {
                closeSemesterModal02();
            }
        });

        // Close on Escape key (either modal)
        document.addEventListener('keydown', function (e) {
            if (e.key !== 'Escape') return;
            if (semesterModalOverlay02.classList.contains('is-open02')) {
                closeSemesterModal02();
            }
            if (academicYearModalOverlay02.classList.contains('is-open02')) {
                closeAcademicYearModal02();
            }
        });




    </script>

    @include('AdminSide.javascript')
</body>

</html>