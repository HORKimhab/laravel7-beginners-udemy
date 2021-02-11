<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // One tag belongs to many hobby
    public function hobbies(){
        return $this->belongsToMany('App\Hobby');
    }

    public function filteredHobbies(){
        return $this->belongsToMany('App\Hobby')
        /*  More about wherePivot
            Filtering Relationships Via Intermediate Table Columns
            https://laravel.com/docs/7.x/eloquent-relationships#many-to-many
        */
        ->wherePivot('tag_id', $this->id) /* e.g: SELECT * FROM `hobby_tag` WHERE `tag_id`=1 */
        ->orderBy('updated_at', 'DESC'); /* updated_at in table hobbies */
    }

    protected $fillable = [
        'name', 'style', 'is_delete',
    ];

}