<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hobby;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hobbies = Hobby::where(['is_delete' => 0, 'user_id' => auth()->user()->id])
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10);
        // dd($hobby);

        $data = [
            'hobbies'=> $hobbies
        ];

        return view('home')->with($data);
    }
}