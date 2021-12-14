<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function render($id)
    {
        $post = Post::find($id);
        $latest_posts = Post::orderBy('created_at', 'DESC')->where('image', '!=', '')->get()->take(3);
        $categories = Category::with('posts')->get();
        return view('post', compact('post', 'categories', 'latest_posts'));
    }
}
