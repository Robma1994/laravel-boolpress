<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'category_id'];
    //inseriamo una funzione con un nome che identifichi la relazione con la tabella primaria.
    public function category() {
        //Un post appartiene ad una categoria
        return $this->belongsTo('App\Category');
    }
}
