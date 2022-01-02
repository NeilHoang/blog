<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    function comments(){
        return $this->hasMany(Comment::class)->orderBy('id','desc');
    }
}
