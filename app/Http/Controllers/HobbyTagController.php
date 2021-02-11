<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class HobbyTagController extends Controller
{
    public function getFilteredHobbies($tag_id){
        // dd('Testing Filter Hobby Tag');

        $tag = new Tag();
        // dd($tag);

        /*  findOrFail | firstOrFail:
            - Not Found Exceptions
            -
            https://laravel.com/docs/7.x/eloquent#retrieving-single-models */

        /* filteredHobbies is a function from file Tag.php */
        $hobbies = $tag::findOrFail($tag_id)->filteredHobbies()->paginate(10);
        $filter = $tag::find($tag_id);

        $data = [
            'hobbies' => $hobbies,
            'filter' => $filter,
        ];

        return view('hobby.index', $data);
    }
}