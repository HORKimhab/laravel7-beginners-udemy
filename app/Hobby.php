<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{

    // Inverse, hobbies belongs to user || a user has many hobbies
    public function user(){
        return $this->belongsTo('App\User');
    }

    // Many to many
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    protected $fillable = [
        'name', 'description', 'user_id'
    ];

}