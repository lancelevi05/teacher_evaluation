<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
for ($i = 1; $i <= 15; $i++) {
            User::create([
                'usn' => '2026' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'lname' => 'StudentLast' . $i,
                'fname' => 'StudentFirst' . $i,
                'mname' => 'M',
                'userType' => 'Student',
                'email' => 'student'.$i.'@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
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
                'email' => 'teacher'.$i.'@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]);
        }
        
    }


}
