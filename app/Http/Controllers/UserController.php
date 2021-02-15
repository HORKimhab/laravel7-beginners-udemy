<?php

namespace App\Http\Controllers;

use App\User;
use App\Hobby;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
        return view('user.edit')->with([
            'user' => $user,
        ]);
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
        // Validation: https://laravel.com/docs/7.x/validation
        $request->validate([
            'name'=>'required|min:3',
            'motto'=>'required|min:3',
            'about_me'=>'required|min:8',
             /* https://laravel.com/docs/7.x/validation#rule-mimetypes */
            /* https://laravel.com/docs/7.x/validation#rule-dimensions */
            /* https://laravel.com/docs/7.x/validation#rule-size */
            /* max:10, 10 kilobytes */
            'image' => 'required|mimes:jpeg,bmp,png,jpg,gif|dimensions:max_width=1200,max_height=900|max:1024',
        ]);

        if($request->image){
            // Call Function
            $imageInput = $request->image;
            $user_id = $user->id;
            // $extensionImage = $request->file('image');
            $this->saveImages($imageInput, $user_id/* , $extensionImage */);
        };

        $user->update([
            'name'          => $request->name,  /* $request['name'] */
            'motto'   => $request['motto'],
            'about_me'   => $request['about_me'],
            /* 'user_id' => auth()->id(), */
        ]);

        /* return $this->index(); */ /* Confirm Form Resubmission */
        return redirect()->route('home')->with([
            'mgs_success'=> 'The user  <b>'. $user->name. '</b>' . ' is updated successfully.',
        ]);
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

    public function saveImages($imageInput, $user_id/* , $extensionImage */)
    {
         $image = Image::make($imageInput);

            /* https://laravel.com/docs/7.x/filesystem */
            // $extension = $request->file('image')->extension();
            // $extension = $extensionImage->extension();
            $path = "/img/users/";
            $extension = 'jpg';

            /* https://www.w3schools.com/php/func_date_date.asp */
            // $time_image = "-" . date('d-m-Y');
            // dd($time_image);
            // dd(public_path(). $path);

            /* http://image.intervention.io/api/height */
            if( $image->width() > $image->height()){ // Landscape
                $image->widen(500) // widen: resize width
                    ->save(public_path(). $path . $user_id /* . $time_image */."_large.".$extension)
                    ->widen(300)->pixelate(12) // apply pixelation effect | burt image
                    ->save(public_path(). $path . $user_id /* . $time_image */ . "_pixelated.".$extension);
                $image = Image::make($imageInput);

                $image->widen(60) // widen: resize width
                     ->save(public_path(). $path . $user_id /* . $time_image */ . "_thumb.".$extension);
            }
            else{
                 $image->heighten(500) // heighten: resize height
                    ->save(public_path() . $path . $user_id /* . $time_image */ ."_large.".$extension)
                    ->heighten(300)->pixelate(12) // apply pixelation effect | burt image
                    ->save(public_path() . $path . $user_id /* . $time_image */ . "_pixelated.".$extension);
                $image = Image::make($imageInput);

                $image->heighten(60) // heighten: resize height
                    ->save(public_path() . $path . $user_id /* . $time_image */ ."_thumb.".$extension);
            }
    }

    public function deleteImage($user_id){
        $path = "/img/users/";
        $extension = 'jpg';

        if(file_exists(public_path(). $path . $user_id /* . $time_image */."_large.".$extension))
            unlink(public_path(). $path . $user_id /* . $time_image */."_large.".$extension) ; // unlink() remove or delete image

        if(file_exists(public_path(). $path . $user_id /* . $time_image */."_thumb.".$extension))
            unlink(public_path(). $path . $user_id /* . $time_image */."_thumb.".$extension) ; // unlink() remove or delete image

        if(file_exists(public_path(). $path . $user_id /* . $time_image */."_pixelated.".$extension))
            unlink(public_path(). $path . $user_id /* . $time_image */."_pixelated.".$extension) ; // unlink() remove or delete image

        return back()->with([
            'mgs_success'=> 'The image is deleted successfully.',
        ]);
    }
}