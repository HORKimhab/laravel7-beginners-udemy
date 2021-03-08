<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Hobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;


class HobbyController extends Controller {
    // Check Login
    // https://laravel.com/docs/7.x/authentication#protecting-routes
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        /* Paginate: https://laravel.com/docs/7.x/pagination#paginating-eloquent-results */
        // $hobbies = Hobby::all()->where('is_delete', 0);
        // $hobbies = Hobby::where('is_delete', 0)->paginate(10);
        $hobbies = Hobby::where('is_delete', 0)->orderBy('created_at', 'DESC')->paginate(10);
        // dd($hobby);

        /* // create Intervention Image
        $img = Image::make('public/foo.jpg');

        dd($img); */

        // $path_image = storage_path();
        // dd(Storage::disk('public')->files());
        // $images = \File::allFiles(public_path('\img\hobbies'));
        // dd($images->filename);
        // dd($images);

        // $file = $request->file('image');

        // $file = $request->photo;
        // dd($file);


        /* Image information */
        /* $request->image = 'image';
        $extensionImage = $request->file('image');
        $extension = $extensionImage->extension();
        $path = "/img/hobbies/";
        dd($extension); */

        $data = [
            'hobbies' => $hobbies
        ];

        return view('hobby.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Validation: https://laravel.com/docs/7.x/validation
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:8',
            /* https://laravel.com/docs/7.x/validation#rule-mimetypes */
            /* https://laravel.com/docs/7.x/validation#rule-dimensions */
            /* https://laravel.com/docs/7.x/validation#rule-size */
            /* max:10, 10 kilobytes */
            'image' => 'required|mimes:jpeg,bmp,png,jpg,gif|dimensions:max_width=1200,max_height=900|max:1024',
        ]);

        $hobby = new Hobby([
            'name'          => $request->name,  /* $request['name'] */
            'description'   => $request['description'],
            'user_id' => auth()->id(),
        ]);

        if ($request->image) {
            // Call Function
            $imageInput = $request->image;
            $hobby_id = $hobby->id;
            // $extensionImage = $request->file('image');
            $this->saveImages($imageInput, $hobby_id/* , $extensionImage */);
        };

        // dd($hobby);
        $hobby->save();
        /* return $this->index(); */ /* Confirm Form Resubmission */

        /* return redirect()->route('hobby.index')->with([
            'mgs_success'=> 'The hobby  <b>'. $hobby->name. '</b>' . ' is created successfully.',
        ]); */

        return redirect('/hobby/' . $hobby->id)->with([
            'mgs_success' => '<i class="fas fa-hand-point-down"></i> The hobby  <b>' . $hobby->name . '</b>' . ' is created successfully.',
            'mgs_warning' => 'Please assign a <b>tag</b> now.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby) {
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
    public function edit(Hobby $hobby) {
        /*  abort_unless
            https://laravel.com/docs/7.x/helpers#method-abort-unless
        */

        abort_unless(Gate::allows('update'), 403);

        /*  Gate::allows
            https://laravel.com/docs/7.x/authorization#authorizing-actions-via-gates
        */

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
    public function update(Request $request, Hobby $hobby) {
        /*  abort_unless
            https://laravel.com/docs/7.x/helpers#method-abort-unless
        */

        abort_unless(Gate::allows('update'), 403);

        /*  Gate::allows
            https://laravel.com/docs/7.x/authorization#authorizing-actions-via-gates
        */

        // Validation: https://laravel.com/docs/7.x/validation
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:8',
            /* https://laravel.com/docs/7.x/validation#rule-mimetypes */
            /* https://laravel.com/docs/7.x/validation#rule-dimensions */
            /* https://laravel.com/docs/7.x/validation#rule-size */
            /* max:10, 10 kilobytes */
            'image' => 'required|mimes:jpeg,bmp,png,jpg,gif|dimensions:max_width=1200,max_height=900|max:1024',
        ]);

        if ($request->image) {
            // Call Function
            $imageInput = $request->image;
            $hobby_id = $hobby->id;
            // $extensionImage = $request->file('image');
            $this->saveImages($imageInput, $hobby_id/* , $extensionImage */);
        };

        $hobby->update([
            'name'          => $request->name,  /* $request['name'] */
            'description'   => $request['description'],
            'user_id' => auth()->id(),
        ]);

        /* return $this->index(); */ /* Confirm Form Resubmission */
        return redirect()->route('hobby.index')->with([
            'mgs_success' => 'The hobby  <b>' . $hobby->name . '</b>' . ' is updated successfully.',
        ]);
    }

    /**
     * Resave the specified resource from storage.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hobby $hobby) {
        /*  abort_unless
            https://laravel.com/docs/7.x/helpers#method-abort-unless
        */

        abort_unless(Gate::allows('delete'), 403);

        /*  Gate::allows
            https://laravel.com/docs/7.x/authorization#authorizing-actions-via-gates
        */

        $oldName = $hobby->name;
        /* https://laravel.com/docs/7.x/queries#retrieving-results */
        $delete_hobby = DB::table('hobbies')->where('id', $hobby->id)->update(['is_delete' => 1]);
        return redirect()->route('hobby.index')->with([
            'mgs_success' => 'The hobby  <b>' . $hobby->name . '</b>' . ' is deleted successfully.',
        ]);
    }

    public function saveImages($imageInput, $hobby_id/* , $extensionImage */) {
        $image = Image::make($imageInput);

        /* https://laravel.com/docs/7.x/filesystem */
        // $extension = $request->file('image')->extension();
        // $extension = $extensionImage->extension();
        $path = "/img/hobbies/";
        $extension = 'jpg';

        /* https://www.w3schools.com/php/func_date_date.asp */
        // $time_image = "-" . date('d-m-Y');
        // dd($time_image);
        // dd(public_path(). $path);

        /* http://image.intervention.io/api/height */
        if ($image->width() > $image->height()) { // Landscape
            $image->widen(1200) // widen: resize width
                ->save(public_path() . $path . $hobby_id /* . $time_image */ . "_large." . $extension)
                ->widen(400)->pixelate(12) // apply pixelation effect | burt image
                ->save(public_path() . $path . $hobby_id /* . $time_image */ . "_pixelated." . $extension);
            $image = Image::make($imageInput);

            $image->widen(60) // widen: resize width
                ->save(public_path() . $path . $hobby_id /* . $time_image */ . "_thumb." . $extension);
        } else {
            $image->widen(900) // widen: resize width
                ->save(public_path() . $path . $hobby_id /* . $time_image */ . "_large." . $extension)
                ->widen(400)->pixelate(12) // apply pixelation effect | burt image
                ->save(public_path() . $path . $hobby_id /* . $time_image */ . "_pixelated." . $extension);
            $image = Image::make($imageInput);

            $image->widen(60) // widen: resize width
                ->save(public_path() . $path . $hobby_id /* . $time_image */ . "_thumb." . $extension);
        }
    }

    public function deleteImage($hobby_id) {
        $path = "/img/hobbies/";
        $extension = 'jpg';

        if (file_exists(public_path() . $path . $hobby_id /* . $time_image */ . "_large." . $extension))
            unlink(public_path() . $path . $hobby_id /* . $time_image */ . "_large." . $extension); // unlink() remove or delete image

        if (file_exists(public_path() . $path . $hobby_id /* . $time_image */ . "_thumb." . $extension))
            unlink(public_path() . $path . $hobby_id /* . $time_image */ . "_thumb." . $extension); // unlink() remove or delete image

        if (file_exists(public_path() . $path . $hobby_id /* . $time_image */ . "_pixelated." . $extension))
            unlink(public_path() . $path . $hobby_id /* . $time_image */ . "_pixelated." . $extension); // unlink() remove or delete image

        return back()->with([
            'mgs_success' => 'The image is deleted successfully.',
        ]);
    }
}