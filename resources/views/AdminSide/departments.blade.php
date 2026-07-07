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
                            <h2>Course</h2>
                            <p>Academic programs offered per department.</p>
                        </div>

                        <div class="section-actions01">
                            <input type="text" class="search-input01" id="searchSection01"
                                placeholder="Search section...">

                            <button class="search-btn01" id="searchBtn01">
                                🔍
                            </button>

                            <button class="add-btn01" id="addBtn01">
                                + Add Section
                            </button>
                        </div>

                    </div>



                    <div class="sections-container">

                        <!-- LEFT : TABLE -->
                        <div class="card table-card">
                            <h2>Departments List</h2>

                            @if($departments->isEmpty())
                                <div class="no-data">
                                    No data existed.
                                </div>
                            @else
                                <div class="table-wrapper">
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

                                    @if(session('error')) <!------ THIS 2ND ERROR DIV FOR TRY CATCH ERROR FLASH-->
                                        <div class="error-msg">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <table class="sections-table">
                                        <thead>
                                            <tr>
                                                <th>CODE</th>
                                                <th>NAME</th>
                                                <th>HEAD</th>
                                                <th>TEACHERS</th>
                                                <th>COURSES</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($departments as $department)
                                                <tr>
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
                                                    <td><button type="button" class="edit-btn01" data-id="{{ $department->id }}"
                                                            data-name="{{ $department->name }}"
                                                            data-code="{{ $department->code }}"
                                                            data-head_id="{{ $department->head_id }}"
                                                            data-head_name="{{ $teacher ? $teacher->lname . ', ' . $teacher->fname : 'Unassigned' }}">
                                                            EDIT
                                                        </button>

                                                        <form action="{{ route('departments.destroy', $department->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                onclick="return confirm('Delete this section?')">
                                                                DELETE
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


                        <!-- RIGHT : FORM -->
                        <div class="card form-card">
                            <h2 id="formTitle01">Add Department</h2>

                            <form method="POST" id="sectionForm01" action="{{ route('departments.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label>Department Name</label>
                                    <input id="name01" type="text" name="name" placeholder="Enter id strand or course"
                                        required>

                                    <label>Code</label>
                                    <input id="code01" type="text" name="code" placeholder="e.g CS" required>

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

                                <button class="btn-submit" id="submitBtn01">Save Department</button>
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
        const form01 = document.getElementById("sectionForm01");
        const formTitle01 = document.getElementById("formTitle01");


        const code01 = document.getElementById("code01");
        const head_id01 = document.getElementById("head_id01");
        const name01 = document.getElementById("name01");


        const submitBtn01 = document.getElementById("submitBtn01");

        document.querySelectorAll(".edit-btn01").forEach(btn => {

            btn.addEventListener("click", function () {

                formTitle01.textContent = "Edit Subject";

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

            });

        });

        const addBtn01 = document.getElementById("addBtn01");

        addBtn01.addEventListener("click", function () {

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
            // Reset all form inputs
            form01.reset();

            // Back to Add mode
            formTitle01.textContent = "Add Department";
            submitBtn01.textContent = "Save Department";

            // Restore form action
            form01.action = "{{ route('departments.store') }}";

            // Remove PUT method if it exists
            const methodField = document.getElementById("methodField01");
            if (methodField) {
                methodField.remove();
            }

            // Reset dropdown placeholders
            department01.selectedIndex = 0;
            category01.selectedIndex = 0;
        });
    </script>

    @include('AdminSide.javascript')
</body>

</html>