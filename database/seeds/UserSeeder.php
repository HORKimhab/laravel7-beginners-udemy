<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /* https://laravel.com/docs/7.x/seeding#using-model-factories */
        factory(App\User::class, 100)->create();

        DB::table('users')->insert([
            'name' => 'Kimhab Coding',
            'email' => 'kimhab.coding@gmail.com',
            'password' => Hash::make('admin007'),
        ]);
    }
}