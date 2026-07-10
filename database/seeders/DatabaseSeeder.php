<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\QuestionCategory;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        QuestionCategory::create([
        'name' => 'Teaching Skills',
        'description' => 'Clarity, methods, and delivery of lessons',
    ]);

    QuestionCategory::create([
        'name' => 'Knowledge',
        'description' => 'Command of the subject matter',
    ]);

    QuestionCategory::create([
        'name' => 'Communication',
        'description' => 'How well the teacher communicates with students',
    ]);

    QuestionCategory::create([
        'name' => 'Professionalism',
        'description' => 'Punctuality, fairness, and conduct',
    ]);

    QuestionCategory::create([
        'name' => 'Classroom Management',
        'description' => 'Discipline and control of the classroom',
    ]);

    QuestionCategory::create([
        'name' => 'Overall Satisfaction',
        'description' => 'General student satisfaction',
    ]);

     $questions = [
        [
            'category_id' => 1,
            'question_text' => 'Explains lessons clearly.',
            'type' => 'likert',
            'is_active' => true,
        ],
        [
            'category_id' => 1,
            'question_text' => 'Uses appropriate teaching methods.',
            'type' => 'likert',
            'is_active' => true,
        ],
        [
            'category_id' => 1,
            'question_text' => 'Comes prepared for class.',
            'type' => 'likert',
            'is_active' => true,
        ],
        [
            'category_id' => 2,
            'question_text' => 'Demonstrates strong command of the subject.',
            'type' => 'likert',
            'is_active' => true,
        ],
        [
            'category_id' => 3,
            'question_text' => 'Encourages student participation.',
            'type' => 'likert',
            'is_active' => true,
        ],
        [
            'category_id' => 3,
            'question_text' => 'Communicates ideas effectively.',
            'type' => 'likert',
            'is_active' => true,
        ],
        [
            'category_id' => 4,
            'question_text' => 'Treats students fairly.',
            'type' => 'likert',
            'is_active' => true,
        ],
        [
            'category_id' => 4,
            'question_text' => 'Is punctual and well-organized.',
            'type' => 'likert',
            'is_active' => true,
        ],
        [
            'category_id' => 5,
            'question_text' => 'Maintains good classroom discipline.',
            'type' => 'likert',
            'is_active' => true,
        ],
        [
            'category_id' => 6,
            'question_text' => 'Overall, I am satisfied with this teacher.',
            'type' => 'likert',
            'is_active' => true,
        ],
        [
            'category_id' => 6,
            'question_text' => 'Additional comments (optional).',
            'type' => 'text',
            'is_active' => true,
        ],
    ];

    foreach ($questions as $question) {
        Question::create($question);
    }

        

        User::create([
            'usn' => '2022621300',
            'fname' => 'Java',
            'lname' => 'Lance',
            'mname' => 'Molato',
            'email' => 'lancelevi05@gmail.com',
            'password' => Hash::make('password'),
            'userType' => 'Student',
            'status' => 'Active'
        ]);

      

        User::create([
            'usn' => '09936303219',
            'fname' => 'Dondoyano',
            'lname' => 'Louise Mae',
            'mname' => 'Ponso',
            'email' => 'javalance05@gmail.com',
            'password' => Hash::make('password'),
            'userType' => 'Admin',
            'status' => 'Active'
        ]);
        User::create([
            'usn' => '09536313219',
            'fname' => 'Leah',
            'lname' => 'Mante',
            'mname' => 'Dela Cruz',
            'email' => 'javalance06@gmail.com',
            'password' => Hash::make('password'),
            'userType' => 'Teacher',
        ]);
        User::create([
            'usn' => '09627645189',
            'fname' => 'Angela',
            'lname' => 'Garcia',
            'mname' => 'Lopez',
            'email' => 'angela.garcia@example.com',
            'password' => Hash::make('password'),
            'userType' => 'Teacher',
            'status' => 'Active'
        ]);
        User::create([
            'usn' => '09568341879',
            'fname' => 'Karen',
            'lname' => 'Torres',
            'mname' => 'Flores',
            'email' => 'karen.torres@example.com',
            'password' => Hash::make('password'),
            'userType' => 'Teacher',
            'status' => 'Active'
        ]);

        Department::create([
            'name' => 'Computer Studies',
            'code' => 'CS'

        ]);
        Department::create([
            'name' => 'Hospitality Management',
            'code' => 'HM'

        ]);

        Department::create([
            'name' => 'Business Department',
            'code' => 'BS'

        ]);


        for ($i = 1; $i <= 15; $i++) {
            User::create([
                'usn' => '2026' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'lname' => 'StudentLast' . $i,
                'fname' => 'StudentFirst' . $i,
                'mname' => 'M',
                'userType' => 'Student',
                'email' => 'student' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),

                'status' => 'Active',
            ]);
        }

        // ==========================
        // Teachers (5)
        // ==========================
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'usn' => 'TCH-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'lname' => 'TeacherLast' . $i,
                'fname' => 'TeacherFirst' . $i,
                'mname' => 'T',
                'userType' => 'Teacher',
                'email' => 'teacher' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),

                'status' => 'Active',

            ]);
        }

    }


}
