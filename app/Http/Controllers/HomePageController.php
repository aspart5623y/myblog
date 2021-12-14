<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function render()
    {
        $random_posts = Post::inRandomOrder()->where('image', '!=', '')->get()->take(3);
        $latest_posts = Post::orderBy('created_at', 'DESC')->where('image', '!=', '')->get()->take(3);
        return view('index', compact('latest_posts', 'random_posts'));
    }
}
