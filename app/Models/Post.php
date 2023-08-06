<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['blog_id', 'name', 'content'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

}
