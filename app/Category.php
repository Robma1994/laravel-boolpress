<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];
    //inseriamo una funzione con un nome che identifichi la relazione con la tabella secondaria.
    public function posts() {
        //La categoria ha molti post
        return $this->hasMany('App\Post');
    }
}
