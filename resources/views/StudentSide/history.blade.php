<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('StudentSide.css')


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


        .rating-badge {
            display: inline-block;
            min-width: 42px;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            text-align: center;
            color: #fff;
            letter-spacing: 0.3px;
        }

        .rating-excellent {
            background: #d4edda;
            color: #1e7e34;
        }

        .rating-good {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .rating-average {
            background: #fff3cd;
            color: #92700f;
        }

        .rating-poor {
            background: #fdecea;
            color: #a12622;
          
        }

        .rating-bad {
            background: #fdecea;
            color: #a12622;
        }
    </style>
</head>

<body style="height:100%;margin:0">
    <div class="app-wrapper">
        <div class="app-body">
            <!-- Sidebar -->
            @include('StudentSide.dashboard')
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
                            <h2>Evaluation History</h2>
                            <p>All evaluations you have submitted.</p>
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

                            @if($evaluations->isEmpty())
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
                                                <th>RATING</th>
                                                <th>MODE</th>
                                                <th>SUBMITTED</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($evaluations as $evaluation)
                                                <tr>
                                                    <td>
                                                        {{ $evaluation->teacher->user->fname }}
                                                    </td>
                                                    <td>
                                                        {{ $evaluation->subject->code }} - {{ $evaluation->subject->name }}
                                                    </td>
                                                    <td>
                                                        {{ $evaluation->semester->name }}
                                                        {{ $evaluation->semester->academicyear->year_label }}
                                                    </td>

                                                    <td>
                                                        @php
                                                            $rating = $evaluation->overall_rating;

                                                            if ($rating >= 4.5) {
                                                                $ratingClass = 'rating-excellent';
                                                            } elseif ($rating >= 3.5) {
                                                                $ratingClass = 'rating-good';
                                                            } elseif ($rating >= 2.5) {
                                                                $ratingClass = 'rating-average';
                                                            } elseif ($rating >= 1.5) {
                                                                $ratingClass = 'rating-poor';
                                                            } else {
                                                                $ratingClass = 'rating-bad';
                                                            }
                                                        @endphp

                                                        <span class="rating-badge {{ $ratingClass }}">
                                                            {{ number_format($rating, 1) }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        @if($evaluation->is_anonymous == 1)
                                                            Anonymous

                                                        @else
                                                            Not Anonymous
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{ $evaluation->created_at->format('M d, Y g:i A') }}
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








    @include('StudentSide.javascript')


</body>

</html>