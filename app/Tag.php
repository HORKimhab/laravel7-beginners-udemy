<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // One tag belongs to many hobby
    public function hobbies(){
        return $this->belongsToMany('App\Hobby');
    }

    protected $fillable = [
        'name', 'style', 'is_delete',
    ];

}