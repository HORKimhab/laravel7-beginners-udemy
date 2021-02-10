<?php

namespace App\Http\Controllers;

use App\Hobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Paginate: https://laravel.com/docs/7.x/pagination#paginating-eloquent-results */
        // $hobbies = Hobby::all()->where('is_delete', 0);
        $hobbies = Hobby::where('is_delete', 0)->paginate(10);
        // dd($hobby);

        $data = [
            'hobbies'=> $hobbies
        ];

        return view('hobby.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation: https://laravel.com/docs/7.x/validation
        $request->validate([
            'name'=>'required|min:3',
            'description'=>'required|min:8',
        ]);

        $hobby = new Hobby([
            'name'          => $request->name,  /* $request['name'] */
            'description'   => $request['description'],
        ]);

        // dd($hobby);
        $hobby->save();
        /* return $this->index(); */ /* Confirm Form Resubmission */
        return redirect()->route('hobby.index')->with([
            'mgs_success'=> 'The hobby  <b>'. $hobby->name. '</b>' . ' is created successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby)
    {
        return view('hobby.show')->with([
            'hobby' => $hobby,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function edit(Hobby $hobby)
    {
        return view('hobby.edit')->with([
            'hobby' => $hobby,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hobby $hobby)
    {
        // Validation: https://laravel.com/docs/7.x/validation
        $request->validate([
            'name'=>'required|min:3',
            'description'=>'required|min:8',
        ]);

        $hobby->update([
            'name'          => $request->name,  /* $request['name'] */
            'description'   => $request['description'],
        ]);

        /* return $this->index(); */ /* Confirm Form Resubmission */
        return redirect()->route('hobby.index')->with([
            'mgs_success'=> 'The hobby  <b>'. $hobby->name. '</b>' . ' is updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hobby $hobby)
    {
        $oldName = $hobby->name;
        /* https://laravel.com/docs/7.x/queries#retrieving-results */
        $delete_hobby = DB::table('hobbies')->where('id', $hobby->id)->update(['is_delete'=>1]);
        return redirect()->route('hobby.index')->with([
            'mgs_success'=> 'The hobby  <b>'. $hobby->name. '</b>' . ' is deleted successfully.',
        ]);
    }
}