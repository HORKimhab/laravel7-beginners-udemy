<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Hobby;
use Illuminate\Support\Facades\Gate;

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

    /*  Wanna know more about -->Detach & Attach<---
        https://laravel.com/docs/7.x/eloquent-relationships#updating-many-to-many-relationships
    */
    public function detachTag($hobby_id, $tag_id){
        $hobby = Hobby::find($hobby_id);

        if(Gate::denies('connect_hobbyTag', $hobby)){
            abort(403, 'This hobby is not yours');
        };

        $tag = Tag::find($tag_id);
        $hobby->tags()->detach($tag_id);

        return back()->with([
            'mgs_warning'=> 'The hobby  <b>'. $tag->name. '</b>' . ' is removed.',
        ]);
    }

    public function attachTag($hobby_id, $tag_id){
        $hobby = Hobby::find($hobby_id);

        if(Gate::denies('connect_hobbyTag', $hobby)){
            abort(403, 'This hobby is not yours');
        };

        $tag = Tag::find($tag_id);
        $hobby->tags()->attach($tag_id);

        return back()->with([
            'mgs_success'=> 'The hobby  <b>'. $tag->name. '</b>' . ' is added successfully.',
        ]);
    }
}