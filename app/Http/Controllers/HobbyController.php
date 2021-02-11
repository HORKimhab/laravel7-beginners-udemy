<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Hobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;


class HobbyController extends Controller
{
    // Check Login
    // https://laravel.com/docs/7.x/authentication#protecting-routes
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }
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
        $hobbies = Hobby::where('is_delete', 0)->orderBy('created_at', 'DESC')->paginate(10);
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
            'user_id' => auth()->id(),
        ]);

        // dd($hobby);
        $hobby->save();
        /* return $this->index(); */ /* Confirm Form Resubmission */

        /* return redirect()->route('hobby.index')->with([
            'mgs_success'=> 'The hobby  <b>'. $hobby->name. '</b>' . ' is created successfully.',
        ]); */

        return redirect('/hobby/' . $hobby->id)->with([
            'mgs_success'=> '<i class="fas fa-hand-point-down"></i> The hobby  <b>'. $hobby->name. '</b>' . ' is created successfully.',
            'mgs_warning'=> 'Please assign a <b>tag</b> now.',
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
        /* https://stackoverflow.com/questions/40766734/check-if-a-class-is-a-model-in-laravel-5 */
        // dd($hobby instanceof Collection);

        // dd(is_array($hobby));
        // dd(gettype($hobby)); // Output: object

        /*  diff()-> convert to collection in laravel
            https://laravel.com/docs/7.x/collections#method-diff
        */
        $allTags = Tag::all();
        // dd($allTags);
        $usedTags = $hobby->tags;
        $availableTags = $allTags->diff($usedTags);
        // dd($availableTags);
        // dd($usedTags);

        // $paginator = Hobby::paginate();
        /* $paginator = Hobby::where('is_delete', 0)->orderBy('created_at', 'DESC')->paginate(10);
        $data_json = json_decode($paginator ->toJSON());
        dd($data_json); */

        $data = [
            'hobby' => $hobby,
            'availableTags' => $availableTags,
           /*  'paginator' => $paginator, */
        ];

        return view('hobby.show')->with($data);
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
            'user_id' => auth()->id(),
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