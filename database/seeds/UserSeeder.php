<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Hobby;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Kimhab Coding',
            'email' => 'kimhab.coding@gmail.com',
            'motto' => 'Rphbt',
            'about_me' => 'Short, Secure, Fast and Easy',
            'password' => Hash::make('admin007'),
        ]);

         /* https://laravel.com/docs/7.x/seeding#using-model-factories */
        factory(User::class, 100)->create()
        ->each(function ($user){
            factory(Hobby::class, rand(1,8))->create(
                [
                    'user_id' => $user->id
                ]
            )
            ->each(function ($hobby){
                $tag_ids = range(1,8);
                shuffle($tag_ids);
                /* array_slice: https://www.php.net/manual/en/function.array-slice.php */
                $assignments = array_slice($tag_ids, 0 , rand(0,8));  // e.g 5,2,8
                foreach($assignments as $tag_id){
                    DB::table('hobby_tag')
                    ->insert(
                        [
                            'tag_id' => $tag_id,
                            'hobby_id' => $hobby->id,
                            'created_at' => Now(),
                            'updated_at' => Now(),
                        ]
                        );
                }
            });
        });
    }
}