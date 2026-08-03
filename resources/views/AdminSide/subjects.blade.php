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

        /* TABLE AREA takes full width now (no side form) */
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
        }

        .select-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            background: white;
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

        /* ===== POPUP MODAL ===== */
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
            max-width: 520px;
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

        .hidden {
            display: none !important;
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
                            <h2>Subject</h2>
                            <p>Subjects that can be assigned to teachers each semester.</p>
                        </div>

                        <div class="section-actions01">
                            <input type="text" class="search-input01" id="searchSection01"
                                placeholder="Search section...">

                            <button class="search-btn01" id="searchBtn01">
                                🔍
                            </button>

                            <button type="button" class="add-btn01" id="addBtn01">
                                + Add Subject
                            </button>
                        </div>

                    </div>

                    <div class="sections-container">

                        <!-- TABLE (now full width, form removed) -->
                        <div class="card table-card">

                            @if(session('success'))
                                <div class="success-msg">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="error-msg">
                                    <ul style="margin:0;padding-left:18px;">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($subjects->isEmpty())
                                <div class="no-data">
                                    No data existed.
                                </div>
                            @else
                                <div class="table-wrapper">
                                    <table class="sections-table">
                                        <thead>
                                            <tr>
                                                <th>CODE</th>
                                                <th>SUBJECT</th>
                                                <th>DEPARTMENT</th>
                                                <th>UNITS</th>
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>

                                        <tbody id="sectionTableBody01">
                                            @foreach($subjects as $subject)
                                                <tr class="sectionRow01">
                                                    <td>{{ $subject->code }}</td>
                                                    <td>{{ $subject->name ?? 'N/A' }}</td>
                                                    <td>
                                                        @php
                                                            $info = $departments->firstWhere('id', $subject->department_id);
                                                        @endphp

                                                        {{ $info ? $info->name : '--' }}
                                                    </td>
                                                    <td>{{ $subject->units }}</td>
                                                    <td class="action-cell">
                                                        <button type="button" class="btn-edit edit-btn01" data-id="{{ $subject->id }}"
                                                            data-code="{{ $subject->code }}"
                                                            data-name="{{ $subject->name }}"
                                                            data-units="{{ $subject->units }}"
                                                            data-department="{{ $subject->department_id }}">
                                                            Edit
                                                        </button>

                                                        <form action="{{ route('subjects.destroy', $subject->id) }}"
                                                            method="POST" class="inline-form">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn-delete"
                                                                onclick="return confirm('Delete this section?')">
                                                                Delete
                                                            </button>
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


    <!-- ===================== ADD / EDIT SUBJECT MODAL ===================== -->
    <div class="modal-overlay" id="sectionModal">
        <div class="modal-box card">
            <div class="modal-header">
                <h2 id="formTitle01">Add Subject</h2>
                <button type="button" class="modal-close-btn" id="closeSectionModal">✕</button>
            </div>
            <p class="modal-subtitle">Create or update a subject for a department.</p>

            <form id="sectionForm01" method="POST" action="{{ route('subjects.store') }}">

                <input type="hidden" name="section_id" id="sectionId01">
                @csrf

                <div class="form-group">
                    <label>CODE</label>
                    <input id="code01" type="text" name="code" placeholder="E.g. IT101" required>
                </div>

                <div class="form-group">
                    <label>SUBJECT NAME</label>
                    <input id="subject01" type="text" name="name" placeholder="Enter subject name" required>
                </div>

                <div class="form-group">
                    <label>UNITS</label>
                    <input id="unit01" step="0.5" type="number" value="3" name="units" placeholder="Enter units"
                        required>
                </div>

                <div class="form-group">
                    <label>DEPARTMENT</label>

                    <select id="department01" name="department_id" class="select-input" required>
                        <option value="" disabled selected>Select type</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn-submit" id="submitBtn01" style="margin-top:20px;">
                    Save Subject
                </button>
            </form>
        </div>
    </div>


    <script>

        (function () {
            const overlay = document.getElementById("sectionModal");
            const openBtn = document.getElementById("addBtn01");
            const closeBtn = document.getElementById("closeSectionModal");

            const form01 = document.getElementById("sectionForm01");
            const formTitle01 = document.getElementById("formTitle01");
            const code01 = document.getElementById("code01");
            const subject01 = document.getElementById("subject01");
            const unit01 = document.getElementById("unit01");
            const department01 = document.getElementById("department01");
            const sectionId01 = document.getElementById("sectionId01");
            const submitBtn01 = document.getElementById("submitBtn01");

            function openModal() {
                overlay.classList.add("active");
            }

            function closeModal() {
                overlay.classList.remove("active");
            }

            function resetToAddMode() {
                form01.reset();

                formTitle01.textContent = "Add Subject";
                submitBtn01.textContent = "Save Subject";

                form01.action = "{{ route('subjects.store') }}";

                const methodField = document.getElementById("methodField01");
                if (methodField) {
                    methodField.remove();
                }

                department01.selectedIndex = 0;
            }

            // Open modal in "Add" mode
            openBtn?.addEventListener("click", function () {
                resetToAddMode();
                openModal();
            });

            closeBtn?.addEventListener("click", closeModal);

            // click outside modal box closes it
            overlay?.addEventListener("click", function (e) {
                if (e.target === overlay) closeModal();
            });

            // re-open modal automatically if validation failed (old input present)
            @if($errors->any())
                openModal();
            @endif

            // Open modal in "Edit" mode, prefilled
            document.querySelectorAll(".edit-btn01").forEach(btn => {

                btn.addEventListener("click", function () {

                    formTitle01.textContent = "Edit Subject";
                    code01.value = this.dataset.code;
                    subject01.value = this.dataset.name;
                    unit01.value = this.dataset.units;
                    department01.value = this.dataset.department;
                    // sectionId01.value = this.dataset.id;
                    form01.action = "/admin/subjects/" + this.dataset.id;

                    submitBtn01.innerHTML = "Update Subject";

                    if (document.getElementById("methodField01") == null) {

                        const method = document.createElement("input");

                        method.type = "hidden";
                        method.name = "_method";
                        method.value = "PUT";
                        method.id = "methodField01";

                        form01.appendChild(method);
                    }

                    openModal();
                });

            });

        })();
    </script>
    @include('AdminSide.javascript')
</body>

</html>