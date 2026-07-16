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

        /* ===== ADD STUDENT MODAL ===== */
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
                            <h2>Students</h2>
                            <p>Students enrolled and their assigned strand/course &amp; section.</p>
                        </div>

                        <div class="section-actions01">
                            <input type="text" class="search-input01" id="searchSection01"
                                placeholder="Search student...">

                            <button class="search-btn01" id="searchBtn01">
                                🔍
                            </button>

                            <button type="button" class="add-btn01" id="addBtn01">
                                + Add Student
                            </button>
                        </div>

                    </div>
                    <div class="sections-container">



                        <!-- TABLE -->
                        <div class="card table-card">
                            <h2>Students List</h2>

                            @if(session('success'))
                                <div class="success-msg">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($students->isEmpty())
                                <div class="no-data">
                                    No data existed.
                                </div>
                            @else
                                <div class="table-wrapper">
                                    <table class="sections-table">
                                        <thead>
                                            <tr>
                                                <th>STUDENT</th>
                                                <th>COURSE</th>
                                                <th>SECTION</th>
                                                <th>YEAR LEVEL</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($students as $student)
                                                <tr>
                                                    <td>
                                                        <div class="student-name">
                                                            {{ $student->lname }}, {{ $student->fname }}
                                                        </div>
                                                        <div class="student-subtitle">
                                                            {{ $student->usn }}
                                                        </div>
                                                    </td>
                                                    @php
                                                        $info = $student_info->firstWhere('usn', $student->usn);
                                                    @endphp
                                                    <td>{{ $info->strandcourse ?? '--' }}</td>
                                                    <td>
                                                        {{ $info->section ?? '--' }}
                                                    </td>
                                                    <td>
                                                        {{ $info->yglevel ?? '--' }}
                                                    </td>
                                                    <td>
                                                        {{ $student->status ?? 'Active' }}
                                                    </td>
                                                    <td class="action-cell">
                                                        <button type="button" class="btn-edit"
                                                            data-id="{{ $student->id }}"
                                                            data-usn="{{ $student->usn }}"
                                                            data-email="{{ $student->email }}"
                                                            data-fname="{{ $student->fname }}"
                                                            data-lname="{{ $student->lname }}"
                                                            data-mname="{{ $student->mname }}"
                                                            data-category="{{ $info->shs_college ?? '' }}"
                                                            data-strand="{{ $info->idstrandcourse ?? '' }}"
                                                            data-year="{{ $info->yglevel ?? '' }}"
                                                            data-section="{{ $info->section ?? '' }}">
                                                            Edit
                                                        </button>

                                                        <form method="POST"
                                                            action="{{ route('students.destroy', $student->id) }}"
                                                            class="inline-form"
                                                            onsubmit="return confirm('Remove {{ $student->fname }} {{ $student->lname }}? This cannot be undone.');">
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


    <!-- ===================== ADD STUDENT MODAL ===================== -->
    <div class="modal-overlay" id="addStudentModal">
        <div class="modal-box card">
            <div class="modal-header">
                <h2>Add Student</h2>
                <button type="button" class="modal-close-btn" id="closeAddStudentModal">✕</button>
            </div>
            <p class="modal-subtitle">Create a user account and enroll the student in a strand/course.</p>

            @if($errors->any())
                <div class="error-msg">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('students.store') }}">
                @csrf

                <div class="form-grid">

                    <!-- USN -->
                    <div class="form-group">
                        <label>USN</label>
                        <input type="text" name="usn" value="{{ old('usn') }}" placeholder="Enter USN" required>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email"
                            required>
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

                    <!-- CATEGORY -->
                    <div class="form-group full-width">
                        <label>Category</label>
                        <select name="shs_college" id="asCategory" required>
                            <option value="" disabled selected>Select Category</option>
                            <option value="1">SHS</option>
                            <option value="0">College (BS)</option>
                            <option value="2">Degree</option>
                        </select>
                    </div>

                    <!-- STRAND / COURSE -->
                    <div class="form-group full-width hidden" id="asStrandGroup">
                        <label>Strand/Course</label>
                        <select name="idstrandcourse" id="asStrand" required>
                            <option value="" disabled selected>Select STRAND</option>

                            @foreach($strandCourses as $course)
                                <option value="{{ $course->idstrandcourse }}" data-category="{{ $course->shs_college }}"
                                    data-max="{{ $course->max_section }}">
                                    {{ $course->strandcourse }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- YEAR / GRADE LEVEL -->
                    <div class="form-group hidden" id="asYearGroup">
                        <label>Year Level</label>
                        <select name="yglevel" id="asYear" required>
                            <option value="" disabled selected>Select Year</option>

                            <!-- COLLEGE -->
                            <option class="college" value="1">1st Year</option>
                            <option class="college" value="2">2nd Year</option>
                            <option class="college" value="3">3rd Year</option>
                            <option class="college" value="4">4th Year</option>

                            <!-- SHS -->
                            <option class="shs" value="11">Grade 11</option>
                            <option class="shs" value="12">Grade 12</option>
                        </select>
                    </div>

                    <!-- SECTION -->
                    <div class="form-group hidden" id="asSectionGroup">
                        <label>Section</label>
                        <select name="section" id="asSection" required>
                            <option value="" disabled selected>Select SECTION</option>
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn-submit" style="margin-top:20px;">
                    Save Student
                </button>

            </form>
        </div>
    </div>


    <!-- ===================== EDIT STUDENT MODAL ===================== -->
    <div class="modal-overlay" id="editStudentModal">
        <div class="modal-box card">
            <div class="modal-header">
                <h2>Edit Student</h2>
                <button type="button" class="modal-close-btn" id="closeEditStudentModal">✕</button>
            </div>
            <p class="modal-subtitle">Update the student's account and enrollment details.</p>

            <form method="POST" id="editStudentForm" action="">
                @csrf
                @method('PUT')

                <div class="form-grid">

                    <!-- USN -->
                    <div class="form-group">
                        <label>USN</label>
                        <input type="text" name="usn" id="eUsn" placeholder="Enter USN" required>
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

                    <!-- CATEGORY -->
                    <div class="form-group full-width">
                        <label>Category</label>
                        <select name="shs_college" id="eCategory" required>
                            <option value="" disabled>Select Category</option>
                            <option value="1">SHS</option>
                            <option value="0">College (BS)</option>
                            <option value="2">Degree</option>
                        </select>
                    </div>

                    <!-- STRAND / COURSE -->
                    <div class="form-group full-width hidden" id="eStrandGroup">
                        <label>Strand/Course</label>
                        <select name="idstrandcourse" id="eStrand" required>
                            <option value="" disabled>Select STRAND</option>

                            @foreach($strandCourses as $course)
                                <option value="{{ $course->idstrandcourse }}" data-category="{{ $course->shs_college }}"
                                    data-max="{{ $course->max_section }}">
                                    {{ $course->strandcourse }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- YEAR / GRADE LEVEL -->
                    <div class="form-group hidden" id="eYearGroup">
                        <label>Year Level</label>
                        <select name="yglevel" id="eYear" required>
                            <option value="" disabled>Select Year</option>

                            <!-- COLLEGE -->
                            <option class="college" value="1">1st Year</option>
                            <option class="college" value="2">2nd Year</option>
                            <option class="college" value="3">3rd Year</option>
                            <option class="college" value="4">4th Year</option>

                            <!-- SHS -->
                            <option class="shs" value="11">Grade 11</option>
                            <option class="shs" value="12">Grade 12</option>
                        </select>
                    </div>

                    <!-- SECTION -->
                    <div class="form-group hidden" id="eSectionGroup">
                        <label>Section</label>
                        <select name="section" id="eSection" required>
                            <option value="" disabled>Select SECTION</option>
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn-submit" style="margin-top:20px;">
                    Update Student
                </button>

            </form>
        </div>
    </div>


    @include('AdminSide.javascript')

    <script>
        (function () {
            const openBtn = document.getElementById('addBtn01');
            const closeBtn = document.getElementById('closeAddStudentModal');
            const overlay = document.getElementById('addStudentModal');

            const category = document.getElementById('asCategory');
            const strand = document.getElementById('asStrand');
            const yearLevel = document.getElementById('asYear');
            const section = document.getElementById('asSection');

            const strandGroup = document.getElementById('asStrandGroup');
            const yearGroup = document.getElementById('asYearGroup');
            const sectionGroup = document.getElementById('asSectionGroup');

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

            function populateSections(max, selectedSection = '') {
                section.innerHTML = '<option value="" disabled selected>Select SECTION</option>';

                if (!max) return;

                for (let i = 0; i < max; i++) {
                    let letter = String.fromCharCode(65 + i);
                    let opt = document.createElement('option');
                    opt.value = letter;
                    opt.text = letter;

                    if (letter === selectedSection) {
                        opt.selected = true;
                    }

                    section.appendChild(opt);
                }
            }

            category?.addEventListener('change', function () {
                let selectedCategory = this.value;

                strandGroup.classList.remove('hidden');
                yearGroup.classList.add('hidden');
                sectionGroup.classList.add('hidden');

                strand.selectedIndex = 0;
                yearLevel.selectedIndex = 0;
                section.innerHTML = '<option value="" disabled selected>Select SECTION</option>';

                document.querySelectorAll('#asStrand option').forEach(opt => {
                    if (!opt.dataset.category) return;
                    opt.style.display = (opt.dataset.category == selectedCategory) ? 'block' : 'none';
                });
            });

            strand?.addEventListener('change', function () {
                yearGroup.classList.remove('hidden');
                sectionGroup.classList.add('hidden');

                let categoryValue = category.value;

                document.querySelectorAll('#asYear option').forEach(opt => {
                    if (opt.classList.contains('college'))
                        opt.style.display = (categoryValue == 1) ? 'none' : 'block';

                    if (opt.classList.contains('shs'))
                        opt.style.display = (categoryValue == 1) ? 'block' : 'none';
                });
            });

            yearLevel?.addEventListener('change', function () {
                sectionGroup.classList.remove('hidden');

                let max = strand.options[strand.selectedIndex].dataset.max;
                populateSections(max);
            });
        })();

        // ===================== EDIT STUDENT MODAL =====================
        (function () {
            const overlay = document.getElementById('editStudentModal');
            const closeBtn = document.getElementById('closeEditStudentModal');
            const form = document.getElementById('editStudentForm');

            const usn = document.getElementById('eUsn');
            const email = document.getElementById('eEmail');
            const fname = document.getElementById('eFname');
            const lname = document.getElementById('eLname');
            const mname = document.getElementById('eMname');

            const category = document.getElementById('eCategory');
            const strand = document.getElementById('eStrand');
            const yearLevel = document.getElementById('eYear');
            const section = document.getElementById('eSection');

            const strandGroup = document.getElementById('eStrandGroup');
            const yearGroup = document.getElementById('eYearGroup');
            const sectionGroup = document.getElementById('eSectionGroup');

            function closeModal() {
                overlay.classList.remove('active');
            }

            closeBtn?.addEventListener('click', closeModal);

            overlay?.addEventListener('click', function (e) {
                if (e.target === overlay) closeModal();
            });

            function filterStrandByCategory(categoryValue) {
                document.querySelectorAll('#eStrand option').forEach(opt => {
                    if (!opt.dataset.category) return;
                    opt.style.display = (opt.dataset.category == categoryValue) ? 'block' : 'none';
                });
            }

            function filterYearByCategory(categoryValue) {
                document.querySelectorAll('#eYear option').forEach(opt => {
                    if (opt.classList.contains('college'))
                        opt.style.display = (categoryValue == 1) ? 'none' : 'block';

                    if (opt.classList.contains('shs'))
                        opt.style.display = (categoryValue == 1) ? 'block' : 'none';
                });
            }

            function populateSections(max, selectedSection = '') {
                section.innerHTML = '<option value="" disabled>Select SECTION</option>';

                if (!max) return;

                for (let i = 0; i < max; i++) {
                    let letter = String.fromCharCode(65 + i);
                    let opt = document.createElement('option');
                    opt.value = letter;
                    opt.text = letter;

                    if (letter === selectedSection) {
                        opt.selected = true;
                    }

                    section.appendChild(opt);
                }
            }

            // open + prefill modal whenever an Edit button is clicked
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function () {
                    const data = this.dataset;

                    form.action = `/admin/students/${data.id}`;

                    usn.value = data.usn || '';
                    email.value = data.email || '';
                    fname.value = data.fname || '';
                    lname.value = data.lname || '';
                    mname.value = data.mname || '';

                    // reset dependent groups first
                    strandGroup.classList.add('hidden');
                    yearGroup.classList.add('hidden');
                    sectionGroup.classList.add('hidden');
                    strand.selectedIndex = 0;
                    yearLevel.selectedIndex = 0;
                    section.innerHTML = '<option value="" disabled>Select SECTION</option>';

                    if (data.category) {
                        category.value = data.category;
                        filterStrandByCategory(data.category);
                        strandGroup.classList.remove('hidden');
                    } else {
                        category.selectedIndex = 0;
                    }

                    if (data.strand) {
                        strand.value = data.strand;
                        filterYearByCategory(data.category);
                        yearGroup.classList.remove('hidden');
                    }

                    if (data.year) {
                        yearLevel.value = data.year;
                        const max = strand.options[strand.selectedIndex]?.dataset.max;
                        populateSections(max, data.section);
                        sectionGroup.classList.remove('hidden');
                    }

                    overlay.classList.add('active');
                });
            });

            category?.addEventListener('change', function () {
                strandGroup.classList.remove('hidden');
                yearGroup.classList.add('hidden');
                sectionGroup.classList.add('hidden');

                strand.selectedIndex = 0;
                yearLevel.selectedIndex = 0;
                section.innerHTML = '<option value="" disabled>Select SECTION</option>';

                filterStrandByCategory(this.value);
            });

            strand?.addEventListener('change', function () {
                yearGroup.classList.remove('hidden');
                sectionGroup.classList.add('hidden');

                filterYearByCategory(category.value);
            });

            yearLevel?.addEventListener('change', function () {
                sectionGroup.classList.remove('hidden');

                const max = strand.options[strand.selectedIndex]?.dataset.max;
                populateSections(max);
            });
        })();
    </script>
</body>

</html>