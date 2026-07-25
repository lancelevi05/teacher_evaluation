<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('StudentSide.css')
    <style>
        /* CONTAINER */
        .student-form-container {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        /* CARD */
        .student-form-card {
            width: 100%;
            max-width: 900px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* TITLE */
        .form-title {
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: 600;
        }

        .success-banner {
            margin-bottom: 16px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            font-size: 14px;
            line-height: 1.5;
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .success-banner.is-hidden {
            opacity: 0;
            transform: translateY(-6px);
            pointer-events: none;
        }

        /* GRID LAYOUT */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        /* FORM GROUP */
        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 500;
        }

        /* INPUTS */
        .form-group input,
        .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            width: 100%;
        }

        /* BUTTON */
        .btn-submit {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            border: none;
            background: #2563eb;
            color: white;
            font-size: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: .3s;
        }

        .btn-submit:hover {
            background: #1e4ed8;
        }

        /* MOBILE RESPONSIVE */
        @media(max-width:768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .student-form-card {
                padding: 18px;
            }
        }
        .hidden {
    display: none;
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
                        aria-label="Toggle menu">☰</button><span class="top-bar-title">Student Side</span>
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

                    <div class="student-form-container">

                        <div class="card student-form-card">
                            <h2 class="form-title">Student Information</h2>

                            @if(session('success'))
                                <div class="success-banner" id="successBanner" role="status" aria-live="polite">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('student.updateInfo') }}">
                                @csrf
                                 @method('PUT')

                                @php
                                    $selectedCourseId = $studentInfo?->idstrandcourse;
                                    $selectedYearLevel = $studentInfo?->yglevel;
                                    $selectedCategory = $studentInfo?->shs_college;
                                @endphp

                                <div class="form-grid">

                                    <!-- USN -->
                                    <div class="form-group">
                                        <label>USN</label>
                                        <input  type="text" name="usn" readonly placeholder="Enter first name"
                                            value="{{ $studentInfo?->usn ?? Auth::user()->usn }}" required>
                                    </div>

                                    <!-- FIRST NAME -->
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input  type="text" name="fname" readonly placeholder="Enter first name"
                                            value="{{ Auth::user()->fname }}" required>
                                    </div>

                                    <!-- LAST NAME -->
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input  type="text" name="lname" readonly value="{{ Auth::user()->lname }}"
                                            placeholder="Enter last name" required>
                                    </div>

                                    <!-- MIDDLE NAME -->
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input  type="text" name="mname" readonly value="{{ Auth::user()->mname }}"
                                            placeholder="Enter middle name">
                                    </div>

                                    <!-- COLLEGE OR SHS -->
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="shs_college" id="category" required>
                                            <option disabled {{ is_null($selectedCategory) ? 'selected' : '' }}>Select Category</option>
                                            <option value="1" {{ (string) $selectedCategory === '1' ? 'selected' : '' }}>SHS</option>
                                            <option value="0" {{ (string) $selectedCategory === '0' ? 'selected' : '' }}>College (BS)</option>
                                            <option value="2" {{ (string) $selectedCategory === '2' ? 'selected' : '' }}>Degree</option>
                                        </select>
                                    </div>

                                    <!-- STRAND -->
                                    <div class="form-group hidden" id="strandGroup">
                                        <label>Strand/Course</label>
                                        <select name="idstrandcourse" id="strandcourse" required>
                                            <option disabled selected>Select STRAND</option>

                                            @foreach($StrandCourse as $course)
                                                <option value="{{ $course->idstrandcourse }}"
                                                    {{ (string) $selectedCourseId === (string) $course->idstrandcourse ? 'selected' : '' }}
                                                    data-category="{{ $course->shs_college }}"
                                                    data-max="{{ $course->max_section }}">
                                                    {{ $course->strandcourse }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>



                                    <!-- year or grade level -->
                                    <div class="form-group hidden" id="yearGroup">
                                        <label>Year Level</label>
                                        <select name="year_level" id="year_level" required>

                                            <option disabled {{ is_null($selectedYearLevel) ? 'selected' : '' }}>Select Year</option>

                                            <!-- COLLEGE -->
                                            <option class="college" value="1" {{ (string) $selectedYearLevel === '1' ? 'selected' : '' }}>1st Year</option>
                                            <option class="college" value="2" {{ (string) $selectedYearLevel === '2' ? 'selected' : '' }}>2nd Year</option>
                                            <option class="college" value="3" {{ (string) $selectedYearLevel === '3' ? 'selected' : '' }}>3rd Year</option>
                                            <option class="college" value="4" {{ (string) $selectedYearLevel === '4' ? 'selected' : '' }}>4th Year</option>

                                            <!-- SHS -->
                                            <option class="shs" value="11" {{ (string) $selectedYearLevel === '11' ? 'selected' : '' }}>Grade 11</option>
                                            <option class="shs" value="12" {{ (string) $selectedYearLevel === '12' ? 'selected' : '' }}>Grade 12</option>

                                        </select>
                                    </div>

                                    <!-- SECTION -->
                                    <div class="form-group hidden" id="sectionGroup">
                                        <label>section</label>
                                        <select name="section" id="section" required data-selected="{{ $studentInfo?->section }}">
                                            <option disabled {{ is_null($studentInfo?->section) ? 'selected' : '' }}>Select SECTION</option>
                                        </select>
                                    </div>



                                </div>

                                <button type="submit" class="btn-submit">
                                    Save Student
                                </button>

                            </form>
                        </div>

                    </div>

                </main>
            </div>
        </div>
        @include('StudentSide.z-footer')
    </div>


    @include('StudentSide.javascript')
    <script>

const category = document.getElementById('category');
const strand = document.getElementById('strandcourse');
const yearLevel = document.getElementById('year_level');
const section = document.getElementById('section');

const strandGroup = document.getElementById('strandGroup');
const yearGroup = document.getElementById('yearGroup');
const sectionGroup = document.getElementById('sectionGroup');

function populateSections(max, selectedSection = '') {

    section.innerHTML = '<option disabled>Select SECTION</option>';

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


// =============================
// INITIAL STATE
// =============================
strandGroup.classList.add('hidden');
yearGroup.classList.add('hidden');
sectionGroup.classList.add('hidden');

const hasStoredCategory = category.value !== '';
const hasStoredStrand = strand.value !== '';
const hasStoredYear = yearLevel.value !== '';

if (hasStoredCategory) {
    strandGroup.classList.remove('hidden');

    document.querySelectorAll('#strandcourse option').forEach(opt => {
        if (!opt.dataset.category) return;

        opt.style.display = (opt.dataset.category == category.value) ? 'block' : 'none';
    });
}

if (hasStoredStrand) {
    yearGroup.classList.remove('hidden');

    document.querySelectorAll('#year_level option').forEach(opt => {
        if (opt.classList.contains('college')) {
            opt.style.display = (category.value == 1) ? 'none' : 'block';
        }

        if (opt.classList.contains('shs')) {
            opt.style.display = (category.value == 1) ? 'block' : 'none';
        }
    });
}

if (hasStoredYear) {
    sectionGroup.classList.remove('hidden');
    populateSections(strand.options[strand.selectedIndex]?.dataset.max, section.dataset.selected);
}


// =============================
// CATEGORY CHANGE
// =============================
category.addEventListener('change', function () {

    let selectedCategory = this.value;

    // show strand dropdown
    strandGroup.classList.remove('hidden');

    // reset others
    yearGroup.classList.add('hidden');
    sectionGroup.classList.add('hidden');

    strand.selectedIndex = 0;
    yearLevel.selectedIndex = 0;
    section.innerHTML = '<option disabled selected>Select SECTION</option>';

    // FILTER STRANDCOURSE
    document.querySelectorAll('#strandcourse option').forEach(opt => {

        if (!opt.dataset.category) return;

        opt.style.display =
            (opt.dataset.category == selectedCategory)
                ? 'block'
                : 'none';
    });

});


// =============================
// STRAND SELECTED
// =============================
strand.addEventListener('change', function () {

    yearGroup.classList.remove('hidden');
    sectionGroup.classList.add('hidden');

    let categoryValue = category.value;

    // FILTER YEAR LEVEL
    document.querySelectorAll('#year_level option').forEach(opt => {

        if(opt.classList.contains('college'))
            opt.style.display = (categoryValue == 1) ? 'none' : 'block';

        if(opt.classList.contains('shs'))
            opt.style.display = (categoryValue == 1) ? 'block' : 'none';
    });

});


// =============================
// YEAR SELECTED → GENERATE SECTION
// =============================
yearLevel.addEventListener('change', function () {

    sectionGroup.classList.remove('hidden');

    let max =
        strand.options[strand.selectedIndex].dataset.max;

    populateSections(max);

});

</script>
@if(session('success'))
<script>
    const successBanner = document.getElementById('successBanner');

    if (successBanner) {
        window.setTimeout(() => {
            successBanner.classList.add('is-hidden');

            window.setTimeout(() => {
                successBanner.remove();
            }, 400);
        }, 10000);
    }
</script>
@endif
</body>

</html>