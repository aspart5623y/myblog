<?php

namespace App\Models;

use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function replies()
    {
        return $this->hasManyThrough(Reply::class, Comment::class, 'post_id', 'comment_id', 'id', 'id')->orderBy('created_at', 'desc');
    }
    
    public function views()
    {
        return $this->belongsToMany(User::class);
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

