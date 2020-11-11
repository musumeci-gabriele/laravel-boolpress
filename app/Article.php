<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //*  Relazione many to one - User

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
