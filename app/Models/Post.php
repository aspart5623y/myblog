<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $findable)
    {
        $findable = preg_replace("/[^A-Za-z0-9_-]/", '', $findable);
        $searchValues = preg_split('/\s+/', $findable, -1, PREG_SPLIT_NO_EMPTY);

        return $query
            ->where(function($query) use ($searchValues) {
            foreach ($searchValues as $value) {
                $query->orWhere('title', 'LIKE', "%{$value}%")->orWhere('body', 'LIKE', "%{$value}%");
            }
        });
    }

}

