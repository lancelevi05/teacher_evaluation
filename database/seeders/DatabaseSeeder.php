<?php

namespace Database\Seeders;

use App\Models\User;

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
