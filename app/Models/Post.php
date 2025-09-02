<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'title', 'user_id', 'text',
    ];
}
