<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Sport' => 'primary',
            'Relaxtion' => 'secondary',
            'Fun' => 'warning',
            'Nature' => 'success',
            'Inspiration' => 'light',
            'Friend' => 'info',
            'Love' => 'danger',
        ];

        foreach($tags as $key => $value){
            $tag = new Tag([
                'name' => $key,
                'style' => $value,
            ]);
            $tag->save();
        }
        /* DB::table('tags')->insert([
            'name' => $key,
            'style' => $value,
        ]); */
    }
}
