<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index']);
        $this->middleware('admin')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all()->where('is_delete', 0);
        // dd($tag);

        $data = [
            'tags'=> $tags
        ];

        return view('tag.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
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
            'style'=>'required|min:4',
        ]);

        $tag = new Tag([
            'name' => $request->name,  /* $request['name'] */
            /* Str::lower, https://laravel.com/docs/7.x/helpers#method-str-lower */
            'style' => Str::lower($request['style']),
        ]);

        // dd($tag);
        $tag->save();
        /* return $this->index(); */ /* Confirm Form Resubmission */
        return redirect()->route('tag.index')->with([
            'mgs_success'=> 'The tag  <b>'. $tag->name. '</b>' . ' is created successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('tag.show')->with([
            'tag' => $tag,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tag.edit')->with([
            'tag' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        // Validation: https://laravel.com/docs/7.x/validation
        $request->validate([
            'name'=>'required|min:3',
            'style'=>'required|min:4',
        ]);

        $tag->update([
            'name' => $request->name,  /* $request['name'] */
            /* Str::lower, https://laravel.com/docs/7.x/helpers#method-str-lower */
            'style' => Str::lower($request['style']),
        ]);

        /* return $this->index(); */ /* Confirm Form Resubmission */
        return redirect()->route('tag.index')->with([
            'mgs_success'=> 'The tag  <b>'. $tag->name. '</b>' . ' is updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
         $oldName = $tag->name;
        /* https://laravel.com/docs/7.x/queries#retrieving-results */
        $delete_tag = DB::table('tags')->where('id', $tag->id)->update(['is_delete'=>1]);
        return redirect()->route('tag.index')->with([
            'mgs_success'=> 'The tag  <b>'. $tag->name. '</b>' . ' is deleted successfully.',
        ]);
    }
}