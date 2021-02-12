<?php

namespace App\Http\Controllers;

use App\User;
use App\Hobby;
use Illuminate\Http\Request;

class UserController extends Controller
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
        // $hobbies = Hobby::where('is_delete', 0)->paginate(10);
        /* $hobbies = Hobby::where('is_delete', 0)->orderBy('created_at', 'DESC')->paginate(10);
        // dd($hobby);

        $data = [
            'hobbies'=> $hobbies
        ];

        return view('hobby.index')->with($data); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        /* $hobbies = Hobby::where(['is_delete' => 0, 'user_id' => auth()->user()->id])
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10); */
        return view('user.show')->with([
            'user' => $user,
            /* 'hobbies' => $hobbies, */
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}