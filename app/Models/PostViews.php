<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostViews extends Model
{
    use HasFactory;

    protected $table = 'post_user';

    protected $fillable = ['post_id', 'user_id'];
}
