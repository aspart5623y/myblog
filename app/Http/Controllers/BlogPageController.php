<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function render()
    {
        $categories = Category::with('posts')->get();
        $latest_posts = Post::orderBy('created_at', 'DESC')->where('image', '!=', '')->where('status', 'approved')->get()->take(3);
        $posts = Post::orderBy('created_at', 'DESC')->where('status', 'approved')->paginate(6);
        // $comment = $posts->comments;
        return view('blog', compact('posts', 'categories', 'latest_posts'));
    }
}
