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






        .modal-overlay {
            opacity: 0;
            visibility: hidden;
            transition: .25s;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-box {
            transform: scale(.95);
            transition: .25s ease;
        }

        .modal-overlay.active .modal-box {
            transform: scale(1);
        }

        /* ===== QUESTIONNAIRE BUILDER ===== */

        .sections-container {
            flex-direction: column;
        }

        .category-panel {
            background: #fff;
            border-radius: 12px;
            padding: 20px 22px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .category-title {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0;
        }

        .category-desc {
            font-size: 13px;
            color: #8d8d97;
            margin: 2px 0 0;
        }

        .btn-icon-danger {
            background: #fff;
            border: 1px solid #f5c6cb;
            color: #dc3545;
            border-radius: 8px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            padding: 0;
        }

        .btn-icon-danger:hover {
            background: #fdf2f3;
        }

        .btn-icon-danger-sm {
            width: 32px;
            height: 32px;
        }

        .question-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #eef0f4;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 12px;
            gap: 12px;
        }

        .question-row:last-child {
            margin-bottom: 0;
        }

        .question-text {
            font-size: 14px;
            color: #2b2b38;
        }

        .badge-type {
            background: #eef0ff;
            color: #4b4bff;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            margin-right: 10px;
            white-space: nowrap;
        }

        .badge-inactive {
            background: #f1f2f4;
            color: #6c757d;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            margin-left: 10px;
            white-space: nowrap;
        }

        .question-actions {
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }

        .question-actions form {
            margin: 0;
        }

        .btn-disable {
            border: 1px solid #d7d9de;
            background: #fff;
            color: #495057;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-disable:hover {
            background: #f5f6fa;
        }

        .no-questions {
            color: #999;
            font-style: italic;
            font-size: 13px;
            margin: 0;
        }

        .no-data-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .modal-box .form-group label,
        .modal-box label {
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .modal-box {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 16px;
        }

        .modal-footer-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 8px;
        }

        .btn-cancel {
            background: #fff;
            border: 1px solid #d7d9de;
            color: #495057;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
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
                            <h2>Questionnaire Builder</h2>
                            <p>This is the heart of the system — build evaluation categories and questions.</p>
                        </div>

                        <div class="section-actions01">
                            <button class="add-btn01" id="addCategoryBtn01">
                                + Add Category
                            </button>

                            <button class="add-btn01" id="addQuestionBtn01">
                                + Add Question
                            </button>
                        </div>

                    </div>

                    @if(session('success'))
                    <div class="success-msg">{{ session('success') }}</div>
                    @endif

                    <div class="sections-container">

                        @if($categories->isEmpty())
                        <div class="card no-data-card text-center">
                            <p class="no-data">No categories yet. Start by adding a category.</p>
                        </div>
                        @endif

                        @foreach($categories as $cat)
                        <div class="category-panel">
                            <div class="category-header">
                                <div>
                                    <h4 class="category-title">{{ $cat->name }}</h4>
                                    <p class="category-desc">{{ $cat->description }}</p>
                                </div>
                                <form method="POST" action="#"
                                    onsubmit="return confirm('Delete this category and all its questions?') &amp;&amp; false;">
                                    {{-- @csrf / route('admin.categories.destroy', $cat->id) once wired to a real controller --}}
                                    <button type="submit" class="btn-icon-danger" title="Delete category">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>

                            @if($cat->questions->isEmpty())
                            <p class="no-questions">No questions in this category yet.</p>
                            @else
                            @foreach($cat->questions as $q)
                            <div class="question-row">
                                <div class="question-text">
                                    <span class="badge-type">{{ ucfirst(str_replace('_', ' ', $q->type)) }}</span>
                                    {{ $q->question_text }}
                                    @if(!$q->is_active)
                                    <span class="badge-inactive">Inactive</span>
                                    @endif
                                </div>
                                <div class="question-actions">
                                    <form method="POST" action="{{ route('questionnaire.toggle', $q) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn-disable"
                                            onclick="return confirm('Are you sure you want to {{ $q->is_active ? 'disable' : 'enable' }} this question?')">
                                            {{ $q->is_active ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="#"
                                        onsubmit="return confirm('Delete this question?') &amp;&amp; false;">
                                        {{-- @csrf / route('admin.questions.destroy', $q->id) once wired to a real controller --}}
                                        <button type="submit" class="btn-icon-danger btn-icon-danger-sm" title="Delete question">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        @endforeach

                    </div>
                </main>
            </div>
        </div>
        <footer class="app-footer"><span id="footerText">© 2025 Lance Levi Java. All rights reserved.</span>
        </footer>
    </div>

    <!-- Add Category Modal -->
    <div class="modal-overlay" id="categoryModal">
        <div class="modal-box">
            <h5 class="modal-title">Add Category</h5>
            <form method="POST" action="#" onsubmit="return false;">
                {{-- @csrf / route('admin.categories.store') once wired to a real controller --}}
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" placeholder="e.g. Teaching Skills" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" placeholder="Short description">
                </div>
                <div class="modal-footer-actions">
                    <button type="button" class="btn-cancel" data-close="categoryModal">Cancel</button>
                    <button type="submit" class="btn-submit" style="width:auto;padding:10px 20px;">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Question Modal -->
    <div class="modal-overlay" id="questionModal">
        <div class="modal-box">
            <h5 class="modal-title">Add Question</h5>
            <form method="POST" action="{{ route('questionnaire.store') }}" >
               @csrf
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="select-input" required>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Question Text</label>
                    <textarea name="question_text" rows="2" class="select-input" required></textarea>
                </div>
                <div class="form-group">
                    <label>Question Type</label>
                    <select name="type" class="select-input">
                        <option value="likert">Likert Scale (1–5)</option>
                        <option value="multiple_choice">Multiple Choice</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="yes_no">Yes / No</option>
                        <option value="text">Text Comment</option>
                    </select>
                </div>
                <div class="modal-footer-actions">
                    <button type="button" class="btn-cancel" data-close="questionModal">Cancel</button>
                    <button type="submit" class="btn-submit" style="width:auto;padding:10px 20px;">Save Question</button>
                </div>
            </form>
        </div>
    </div>

    @include('AdminSide.javascript')

    <script>
        (function() {
            function openModal(id) {
                var el = document.getElementById(id);
                if (el) el.classList.add('active');
            }

            function closeModal(id) {
                var el = document.getElementById(id);
                if (el) el.classList.remove('active');
            }

            var addCatBtn = document.getElementById('addCategoryBtn01');
            var addQBtn = document.getElementById('addQuestionBtn01');
            if (addCatBtn) addCatBtn.addEventListener('click', function() {
                openModal('categoryModal');
            });
            if (addQBtn) addQBtn.addEventListener('click', function() {
                openModal('questionModal');
            });

            document.querySelectorAll('[data-close]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    closeModal(btn.getAttribute('data-close'));
                });
            });

            document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
                overlay.addEventListener('click', function(e) {
                    if (e.target === overlay) overlay.classList.remove('active');
                });
            });
        })();
    </script>
</body>

</html>