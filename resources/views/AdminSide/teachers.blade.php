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

        /* ===== ADD TEACHER MODAL ===== */
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
            max-width: 640px;
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

        /* ===== ACTION BUTTONS ===== */
        .action-cell {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .inline-form {
            display: inline;
        }

        .btn-edit,
        .btn-delete {
            border: none;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: .15s;
        }

        .btn-edit {
            background: #fff3cd;
            color: #92700f;
        }

        .btn-edit:hover {
            background: #ffe8a1;
        }

        .btn-delete {
            background: #fdecea;
            color: #a12622;
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
                            <h2>Teachers</h2>
                            <p>Teachers and their assigned department.</p>
                        </div>

                        <div class="section-actions01">
                            <input type="text" class="search-input01" id="searchSection01"
                                placeholder="Search teacher...">

                            <button class="search-btn01" id="searchBtn01">
                                🔍
                            </button>

                            <button type="button" class="add-btn01" id="addBtn01">
                                + Add Teacher
                            </button>
                        </div>

                    </div>
                    <div class="sections-container">



                        <!-- TABLE -->
                        <div class="card table-card">
                            <h2>Teachers List</h2>

                            @if(session('success'))
                                <div class="success-msg">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($teachers->isEmpty())
                                <div class="no-data">
                                    No data existed.
                                </div>
                            @else
                                <div class="table-wrapper">
                                    <table class="sections-table">
                                        <thead>
                                            <tr>
                                                <th>TEACHER</th>
                                                <th>DEPARTMENT</th>

                                                <th>STATUS</th>
                                                <th>RATING</th>
                                                <th>EVALUATIONS</th>
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($teachers as $teacher)
                                                @php
                                                    $info = $teacher_info->firstWhere('user_id', $teacher->id);
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="student-name">
                                                            {{ $teacher->lname }}, {{ $teacher->fname }}
                                                        </div>
                                                        <div class="student-subtitle">
                                                            {{ $info->employee_id ?? '--' }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $info->department_name ?? '--' }}</td>

                                                    <td>{{ $teacher->status ?? 'Active' }}</td>
                                                    <td>{{ $info->rating ?? '--' }}</td>
                                                    <td>{{ $info->evaluations_count ?? '--' }}</td>
                                                    <td class="action-cell">
                                                        <button type="button" class="btn-edit" data-id="{{ $teacher->id }}"
                                                            data-usn="{{ $teacher->usn }}" data-email="{{ $teacher->email }}"
                                                            data-fname="{{ $teacher->fname }}"
                                                            data-lname="{{ $teacher->lname }}"
                                                            data-mname="{{ $teacher->mname }}"
                                                             data-status="{{ $teacher->status }}"
                                                            data-employee-id="{{ $info->employee_id ?? '' }}"
                                                            data-department="{{ $info->department_id ?? '' }}">
                                                            Edit
                                                        </button>

                                                        <form method="POST" action="{{ route('teacher.destroy',$teacher->id) }}" class="inline-form"
                                                            onsubmit="return confirm('Remove {{ $teacher->fname }} {{ $teacher->lname }}? This cannot be undone.');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-delete">Delete</button>
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
        <footer class="app-footer"><span id="footerText">© 2025 Lance Levi Java. All rights reserved.</span>
        </footer>
    </div>


    <!-- ===================== ADD TEACHER MODAL ===================== -->
    <div class="modal-overlay" id="addTeacherModal">
        <div class="modal-box card">
            <div class="modal-header">
                <h2>Add Teacher</h2>
                <button type="button" class="modal-close-btn" id="closeAddTeacherModal">✕</button>
            </div>
            <p class="modal-subtitle">Create a user account and assign the teacher to a department.</p>

            @if($errors->any())
                <div class="error-msg">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('teachers.store') }}">
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" name="employee_id" value="{{ old('employee_id') }}"
                            placeholder="Enter employee ID" required>
                    </div>

                    <!-- USN -->
                    <!-- <div class="form-group">
                        <label>USN</label>
                        <input type="text" name="usn" value="{{ old('usn') }}" placeholder="Enter USN" required>
                    </div> -->

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email" required>
                    </div>

                    <!-- FIRST NAME -->
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" value="{{ old('fname') }}" placeholder="Enter first name"
                            required>
                    </div>

                    <!-- LAST NAME -->
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" value="{{ old('lname') }}" placeholder="Enter last name"
                            required>
                    </div>

                    <!-- MIDDLE NAME -->
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="mname" value="{{ old('mname') }}" placeholder="Enter middle name">
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password" required>
                    </div>

                    <!-- STATUS -->
                    <div class="form-group full-width">
                        <label>Status</label>
                        <select name="status" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Retired">Retired</option>
                        </select>
                    </div>

                    <!-- EMPLOYEE ID -->
                    <!-- <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" name="employee_id" value="{{ old('employee_id') }}"
                            placeholder="Enter employee ID" required>
                    </div> -->

                    <!-- DEPARTMENT -->
                    <div class="form-group full-width">
                        <label>Department</label>
                        <select name="department_id" required>
                            <option value="" disabled selected>Select Department</option>

                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <button type="submit" class="btn-submit" style="margin-top:20px;">
                    Save Teacher
                </button>

            </form>
        </div>
    </div>


    <!-- ===================== EDIT TEACHER MODAL ===================== -->
    <div class="modal-overlay" id="editTeacherModal">
        <div class="modal-box card">
            <div class="modal-header">
                <h2>Edit Teacher</h2>
                <button type="button" class="modal-close-btn" id="closeEditTeacherModal">✕</button>
            </div>
            <p class="modal-subtitle">Update the teacher's account and department assignment.</p>

            <form method="POST" id="editTeacherForm" action="">
                @csrf
                @method('PUT')

                <div class="form-grid">

                    <!-- USN -->
                    <!-- <div class="form-group">
                        <label>USN</label>
                        <input type="text" name="usn" id="eUsn" placeholder="Enter USN" required>
                    </div> -->
                    <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" name="employee_id" id="eEmployeeId" placeholder="Enter employee ID" required>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="eEmail" placeholder="Enter email" required>
                    </div>

                    <!-- FIRST NAME -->
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" id="eFname" placeholder="Enter first name" required>
                    </div>

                    <!-- LAST NAME -->
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" id="eLname" placeholder="Enter last name" required>
                    </div>

                    <!-- MIDDLE NAME -->
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="mname" id="eMname" placeholder="Enter middle name">
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current password">
                    </div>
                    <!-- STATUS -->
                    <div class="form-group full-width">
                        <label>Status</label>
                        <select name="status" id="eStatus" required>
                            <option value="" disabled>Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Retired">Retired</option>
                        </select>
                    </div>

                    <!-- EMPLOYEE ID -->
                    <!-- <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" name="employee_id" id="eEmployeeId" placeholder="Enter employee ID"
                            required>
                    </div> -->

                    <!-- DEPARTMENT -->
                    <div class="form-group full-width">
                        <label>Department</label>
                        <select name="department_id" id="eDepartment" required>
                            <option value="" disabled>Select Department</option>

                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <button type="submit" class="btn-submit" style="margin-top:20px;">
                    Update Teacher
                </button>

            </form>
        </div>
    </div>


    @include('AdminSide.javascript')

    <script>
        (function () {
            const openBtn = document.getElementById('addBtn01');
            const closeBtn = document.getElementById('closeAddTeacherModal');
            const overlay = document.getElementById('addTeacherModal');

            function openModal() {
                overlay.classList.add('active');
            }

            function closeModal() {
                overlay.classList.remove('active');
            }

            openBtn?.addEventListener('click', openModal);
            closeBtn?.addEventListener('click', closeModal);

            // click outside modal box closes it
            overlay?.addEventListener('click', function (e) {
                if (e.target === overlay) closeModal();
            });

            // re-open modal automatically if validation failed (old input present)
            @if($errors->any())
                openModal();
            @endif
        })();

        // ===================== EDIT TEACHER MODAL =====================
        (function () {
            const overlay = document.getElementById('editTeacherModal');
            const closeBtn = document.getElementById('closeEditTeacherModal');
            const form = document.getElementById('editTeacherForm');


            // const usn = document.getElementById('eUsn');
            const email = document.getElementById('eEmail');
            const fname = document.getElementById('eFname');
            const lname = document.getElementById('eLname');
            const mname = document.getElementById('eMname');
            const status = document.getElementById('eStatus');
            const employeeId = document.getElementById('eEmployeeId');
            const department = document.getElementById('eDepartment');

            function closeModal() {
                overlay.classList.remove('active');
            }

            closeBtn?.addEventListener('click', closeModal);

            overlay?.addEventListener('click', function (e) {
                if (e.target === overlay) closeModal();
            });

            // open + prefill modal whenever an Edit button is clicked
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function () {
                    const data = this.dataset;

                    form.action = `/admin/teachers/${data.id}`;

                    // usn.value = data.usn || '';
                    email.value = data.email || '';
                    fname.value = data.fname || '';
                    lname.value = data.lname || '';
                    mname.value = data.mname || '';
                    status.value = data.status || '';
                    employeeId.value = data.employeeId || '';
                    department.value = data.department || '';

                    overlay.classList.add('active');
                });
            });
        })();
    </script>
</body>

</html>