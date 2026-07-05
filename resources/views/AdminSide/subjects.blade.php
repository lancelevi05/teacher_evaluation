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

        .success-msg {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }











        /* ===== HEADER ===== */

        .section-header01 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .section-title01 h2 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            color: #222;
        }

        .section-title01 p {
            margin-top: 5px;
            color: #777;
            font-size: 15px;
        }

        .section-actions01 {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-input01 {
            width: 250px;
            padding: 10px 14px;
            border: 1px solid #dcdcdc;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        .search-input01:focus {
            border-color: #4f46e5;
        }

        .search-btn01 {
            width: 42px;
            height: 42px;
            border: 1px solid #dcdcdc;
            background: #fff;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
        }

        .search-btn01:hover {
            background: #f4f4f4;
        }

        .add-btn01 {
            padding: 10px 18px;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            font-weight: 600;
        }

        .add-btn01:hover {
            background: #4338ca;
        }

        /* ===== MOBILE ===== */

        @media(max-width:768px) {

            .section-header01 {
                flex-direction: column;
                align-items: flex-start;
            }

            .section-actions01 {
                width: 100%;
            }

            .search-input01 {
                flex: 1;
                width: 100%;
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
                            <h2>Sections</h2>
                            <p>Manage strands and courses offered by each department.</p>
                        </div>

                        <div class="section-actions01">
                            <input type="text" class="search-input01" id="searchSection01"
                                placeholder="Search section...">

                            <button class="search-btn01" id="searchBtn01">
                                🔍
                            </button>

                            <button class="add-btn01">
                                + Add Section
                            </button>
                        </div>

                    </div>
                    <div class="sections-container">

                        <!-- LEFT : TABLE -->
                        <div class="card table-card">









                            @if($sections->isEmpty())
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
                                    <table class="sections-table">
                                        <thead>
                                            <tr>
                                                <th>CODE</th>
                                                <th>COURSE NAME</th>
                                                <th>DEPARTMENT</th>
                                                <th>STUDENT</th>
                                                <th>Max Section</th>
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>

                                        <tbody id="sectionTableBody01">
    @foreach($sections as $section)
    <tr class="sectionRow01">
        <td>{{ $section->idstrandcourse }}</td>
        <td>{{ $section->strandcourse ?? 'N/A' }}</td>
        <td>
            @php
                $info = $departments->firstWhere('id', $section->department_id);
            @endphp

            {{ $info ? $info->name : '--' }}
        </td>
        <td>45</td>
        <td>{{ $section->max_section ?? '--' }}</td>
        <td>
            <button>EDIT</button>
            <button>DELETE</button>
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
                            <h2>Add Section</h2>

                            <form method="POST" action="{{ route('sections.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label>CODE</label>
                                    <input type="text" name="idstrandcourse" placeholder="Enter id strand or course"
                                        required>

                                    <label>COURSE NAME</label>
                                    <input type="text" name="strandcourse" placeholder="Enter strand or course"
                                        required>
                                    <label>Max Section</label>
                                    <input type="text" name="max_section" placeholder="Enter Maximum section" required>

                                    <label>DEPARTMENT</label>

                                    <select name="department_id" class="select-input" required>
                                        <option value="" disabled selected>Select type</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <label>Choose Category</label>

                                    <select name="shs_college" class="select-input" required>
                                        <option value="" disabled selected>Select type</option>
                                        <option value="1">SHS</option>
                                        <option value="0">BS</option>
                                        <option value="2">Degree</option>
                                    </select>
                                </div>

                                <button class="btn-submit">Save Section</button>
                            </form>
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