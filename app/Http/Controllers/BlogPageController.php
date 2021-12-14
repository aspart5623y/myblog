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
        $latest_posts = Post::orderBy('created_at', 'DESC')->where('image', '!=', '')->get()->take(3);
        $posts = Post::orderBy('created_at', 'DESC')->paginate(6);
        return view('blog', compact('posts', 'categories', 'latest_posts'));
    }
}
