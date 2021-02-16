<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'name' => 'Kimhab',
            'email' => 'kimhab.coding1@gmail.com',
            /* https://github.com/fzaninotto/Faker#fakerprovideren_ustext */
            'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => Hash::make('admin007'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
        ]);

        $admin->save();
    }
}