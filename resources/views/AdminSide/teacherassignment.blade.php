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
            flex: 1;
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

        .form-group label {
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-submit {
            padding: 10px 22px;
            background: #4338ca;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-submit:hover {
            background: #372ea3;
        }

        .btn-cancel {
            padding: 10px 22px;
            background: #f1f2f6;
            color: #333;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-cancel:hover {
            background: #e4e6ec;
        }

        /* ===== MOBILE RESPONSIVE ===== */
        @media(max-width:900px) {

            .sections-container {
                flex-direction: column;
            }
        }

        .success-msg {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .error-msg {
            background: #fdecea;
            color: #a12622;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
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

        /* ===== NEW ASSIGNMENT MODAL ===== */
        .modal-overlay {
            opacity: 0;
            visibility: hidden;
            transition: .25s;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 40px 16px;
            overflow-y: auto;
            z-index: 1000;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-box {
            transform: scale(.95);
            transition: .25s ease;
            width: 100%;
            max-width: 560px;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
        }

        .modal-overlay.active .modal-box {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .modal-header h2 {
            margin: 0;
        }

        .modal-subtitle {
            color: #7a7a7a;
            font-size: 13px;
            margin: 0 0 20px 0;
        }

        .modal-close-btn {
            border: none;
            background: #f1f2f6;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            color: #555;
        }

        .modal-close-btn:hover {
            background: #e4e6ec;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .form-grid .form-group.full-width {
            grid-column: 1 / -1;
        }

        @media(max-width:640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .hidden {
            display: none !important;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        /* ===== ACTION BUTTONS ===== */
        .action-cell {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .inline-form {
            display: inline;
        }

        .btn-delete {
            border: none;
            background: #fdecea;
            color: #a12622;
            width: 34px;
            height: 34px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: .15s;
        }

        .btn-delete:hover {
            background: #f9d3cf;
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
                            <h2>Subject Assignments</h2>
                            <p>Assign teachers to subjects.</p>
                        </div>

                        <div class="section-actions01">
                            <button type="button" class="add-btn01" id="addBtn01">
                                + New Assignment
                            </button>
                        </div>

                    </div>
                    <div class="sections-container">

                        <!-- TABLE -->
                        <div class="card table-card">

                            @if(session('success'))
                                <div class="success-msg">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($assignments->isEmpty())
                                <div class="no-data">
                                    No data existed.
                                </div>
                            @else
                                <div class="table-wrapper">
                                    <table class="sections-table">
                                        <thead>
                                            <tr>
                                                <th>TEACHER</th>
                                                <th>SUBJECT</th>
                                                <th>SEMESTER</th>
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($assignments as $assignment)
                                                <tr>
                                                    <td>
                                                        <div class="student-name">
                                                            {{ $assignment->teacher->user->fname }}, {{ $assignment->teacher->user->lname }}
                                                        </div>
                                                        @if($assignment->section)
                                                            <div class="student-subtitle">
                                                                Section {{ $assignment->section }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $assignment->subject->code }} — {{ $assignment->subject->name }}
                                                    </td>
                                                    <td>
                                                    {{ $assignment->semester->name }} 
                                                    {{ $assignment->semester->academicyear->year_label}}</td>
                                                    <td class="action-cell">
                                                        <form method="POST"
                                                            action="{{ route('teacherassignment.destroy',$assignment->id) }}"
                                                            class="inline-form"
                                                            onsubmit="return confirm('Remove this assignment? This cannot be undone.');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-delete" title="Delete">🗑</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                    </div>
                </main>
            </div>
        </div>
        <!---FOOTER-->
        @include('AdminSide.z-footer')
        <!---FOOTER-->
    </div>


    <!-- ===================== NEW ASSIGNMENT MODAL ===================== -->
    <div class="modal-overlay" id="addAssignmentModal">
        <div class="modal-box card">
            <div class="modal-header">
                <h2>New Assignment</h2>
                <button type="button" class="modal-close-btn" id="closeAddAssignmentModal">✕</button>
            </div>
            <p class="modal-subtitle">Assign a teacher to a subject for a given semester.</p>

            @if($errors->any())
                <div class="error-msg">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('teacherassignment.store') }}">
                @csrf

                <div class="form-grid">

                    <!-- TEACHER -->
                    <div class="form-group full-width">
                        <label>Teacher</label>
                        <select name="teacher_id" required>
                            <option value="" disabled selected>Select Teacher</option>

                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->user->fname }}, {{ $teacher->user->lname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- SUBJECT -->
                    <div class="form-group full-width">
                        <label>Subject</label>
                        <select name="subject_id" required>
                            <option value="" disabled selected>Select Subject</option>

                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->code }} — {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- SECTION -->
                    <div class="form-group">
                        <label>Section</label>
                        <input type="text" name="section" value="{{ old('section') }}" placeholder="e.g. A">
                    </div>

                    <!-- SEMESTER -->
                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester_id" required>
                            <option value="" disabled selected>Select Semester</option>

                            @foreach($semesters as $semester)
                                <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                    {{ $semester->name }}
                                    {{ $semester->academicyear->year_label }}
                                    
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="cancelAddAssignmentModal">Cancel</button>
                    <button type="submit" class="btn-submit">Save Assignment</button>
                </div>

            </form>
        </div>
    </div>


    @include('AdminSide.javascript')

    <script>
        (function () {
            const openBtn = document.getElementById('addBtn01');
            const closeBtn = document.getElementById('closeAddAssignmentModal');
            const cancelBtn = document.getElementById('cancelAddAssignmentModal');
            const overlay = document.getElementById('addAssignmentModal');

            function openModal() {
                overlay.classList.add('active');
            }

            function closeModal() {
                overlay.classList.remove('active');
            }

            openBtn?.addEventListener('click', openModal);
            closeBtn?.addEventListener('click', closeModal);
            cancelBtn?.addEventListener('click', closeModal);

            // click outside modal box closes it
            overlay?.addEventListener('click', function (e) {
                if (e.target === overlay) closeModal();
            });

            // re-open modal automatically if validation failed (old input present)
            @if($errors->any())
                openModal();
            @endif
        })();
    </script>
</body>

</html>