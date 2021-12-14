<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        $pending_posts = Post::where('status', 'pending')->get();
        $users = User::all();
        $categories = Category::all();
        return view('home', compact('posts', 'pending_posts', 'users', 'categories'));
    }

    public function adminHome()
    {
        $posts = Post::all();
        $pending_posts = Post::where('status', 'pending')->get();
        $users = User::all();
        $categories = Category::all();
        return view('admin.admin-home', compact('posts', 'pending_posts', 'users', 'categories'));
    }
}
