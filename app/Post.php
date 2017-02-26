<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'body'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getRouteKeyName() {
    	return 'slug';
    }
}
