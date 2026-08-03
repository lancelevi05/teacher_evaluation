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
                            <h2>Department</h2>
                            <p>Academic departments and their assigned heads.</p>
                        </div>

                        <div class="section-actions01">
                            <input type="text" class="search-input01" id="searchSection01"
                                placeholder="Search section...">

                            <button class="search-btn01" id="searchBtn01">
                                🔍
                            </button>

                            <button type="button" class="add-btn01" id="addBtn01">
                                + Add Department
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

                            @if(session('error')) <!------ THIS 2ND ERROR DIV FOR TRY CATCH ERROR FLASH-->
                                <div class="error-msg">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if($departments->isEmpty())
                                <div class="no-data">
                                    No data existed.
                                </div>
                            @else
                                <div class="table-wrapper">
                                    <table class="sections-table">
                                        <thead>
                                            <tr>
                                                <th>CODE</th>
                                                <th>NAME</th>
                                                <th>HEAD</th>
                                                <th>TEACHERS</th>
                                                <th>COURSES</th>
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($departments as $department)
                                                <tr class="sectionRow01"">
                                                    <td>{{ $department->code ?? '--' }}</td>
                                                    <td>{{ $department->name }}</td>

                                                    <td>
                                                        @php
                                                            $teacher = $teachers->firstWhere('id', $department->head_id);
                                                        @endphp

                                                        {{ $teacher ? $teacher->fname . ' ' . $teacher->lname : '--' }}
                                                    </td>
                                                    <td>UPDATING</td>
                                                    <td>{{ $department->courses_count }}</td>
                                                    <td class="action-cell">
                                                        <button type="button" class="btn-edit edit-btn01" data-id="{{ $department->id }}"
                                                            data-name="{{ $department->name }}"
                                                            data-code="{{ $department->code }}"
                                                            data-head_id="{{ $department->head_id }}"
                                                            data-head_name="{{ $teacher ? $teacher->lname . ', ' . $teacher->fname : 'Unassigned' }}">
                                                            Edit
                                                        </button>

                                                        <form action="{{ route('departments.destroy', $department->id) }}"
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
        <footer class="app-footer"><span id="footerText">© 2025 Lance Levi Java. All rights reserved.</span>
        </footer>
    </div>


    <!-- ===================== ADD / EDIT DEPARTMENT MODAL ===================== -->
    <div class="modal-overlay" id="sectionModal">
        <div class="modal-box card">
            <div class="modal-header">
                <h2 id="formTitle01">Add Department</h2>
                <button type="button" class="modal-close-btn" id="closeSectionModal">✕</button>
            </div>
            <p class="modal-subtitle">Create or update an academic department.</p>

            <form method="POST" id="sectionForm01" action="{{ route('departments.store') }}">
                @csrf

                <div class="form-group">
                    <label>Department Name</label>
                    <input id="name01" type="text" name="name" placeholder="Enter department name" required>
                </div>

                <div class="form-group">
                    <label>Code</label>
                    <input id="code01" type="text" name="code" placeholder="e.g CS" required>
                </div>

                <div class="form-group">
                    <label>Head Department</label>

                    <select id="head_id01" name="head_id" class="select-input">
                        <option value="">Unnasigned</option>
                        @foreach ($teachers as $teacher)

                            @if(!$departments->contains('head_id', $teacher->id))
                                <option value="{{ $teacher->id }}">
                                    {{ $teacher->lname }}, {{ $teacher->fname }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <button class="btn-submit" id="submitBtn01" style="margin-top:20px;">Save Department</button>
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
            const head_id01 = document.getElementById("head_id01");
            const name01 = document.getElementById("name01");
            const submitBtn01 = document.getElementById("submitBtn01");

            function openModal() {
                overlay.classList.add("active");
            }

            function closeModal() {
                overlay.classList.remove("active");
            }

            function resetToAddMode() {

                /* ============================================================
                //                       TEMPORARY FOR DEPARTMENT HEAD EDIT
                  ============================================================ */
                const existing = document.getElementById("currentHeadOption");
                if (existing) {
                    existing.remove();
                }
                /* ============================================================
                            TEMPORARY FOR DEPARTMENT HEAD EDIT              //
                 ============================================================ */

                form01.reset();

                formTitle01.textContent = "Add Department";
                submitBtn01.textContent = "Save Department";

                form01.action = "{{ route('departments.store') }}";

                const methodField = document.getElementById("methodField01");
                if (methodField) {
                    methodField.remove();
                }

                head_id01.selectedIndex = 0;
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

                    formTitle01.textContent = "Edit Department";

                    name01.value = this.dataset.name;
                    code01.value = this.dataset.code;

                    /* ============================================================
                    //                       TEMPORARY FOR DEPARTMENT HEAD EDIT
                      ============================================================ */
                    // Remove previously added edit option
                    const existing = document.getElementById("currentHeadOption");
                    if (existing) {
                        existing.remove();
                    }

                    // If the current head isn't in the dropdown, add it temporarily
                    if (![...head_id01.options].some(opt => opt.value === this.dataset.head_id)) {
                        const option = document.createElement("option");
                        option.value = this.dataset.head_id;
                        option.text = this.dataset.head_name;
                        option.id = "currentHeadOption";

                        head_id01.appendChild(option);
                    }

                    head_id01.value = this.dataset.head_id;

                    /* ============================================================
                                               TEMPORARY FOR DEPARTMENT HEAD EDIT ///
                      ============================================================ */

                    // sectionId01.value = this.dataset.id;
                    form01.action = "/admin/departments/" + this.dataset.id;

                    submitBtn01.innerHTML = "Update Department";

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