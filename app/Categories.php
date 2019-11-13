<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['categories'];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
