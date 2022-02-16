<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\PostViews;
use App\Events\PostViewed;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        if (Auth::user()->utype == 'admin') {
            $posts = Post::latest()->paginate(6);
        } else {
            $posts = Post::latest()->where('user_id', Auth::user()->id)->paginate(6);
        }
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $latest_posts = Post::latest()->where('image', '!=', '')->get()->take(3);
        $categories = Category::with('posts')->get();
        $comments = $post->comments;
        $views = PostViews::where('post_id', $post->id);

        
        if(Auth::check()) {
            event(new PostViewed($post));
        }

        return view('posts.show', compact('post', 'categories', 'latest_posts', 'comments', 'views'));
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }


    public function store(PostRequest $request, PostRepository $postRepository)
    {
        $validatedData = $request->validated();
        $post = $postRepository->create($validatedData);
        return redirect()->route('post.index')
                ->with('post_validation', 'Your post has been created successfully!');
    }


    public function updateStatus(Post $post)
    {
        $post->status = 'approved';
        $post->save();
        return back()->with('post_validation', 'Your post has been created successfully!');
    }


    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }


    public function update(PostRequest $request, PostRepository $postRepository, Post $post)
    {
        $validatedData = $request->validated();
        $postUpdate = $postRepository->update($validatedData, $post);
        return redirect()->route('post.index')
                ->with('post_validation', 'Your post has been updated successfully!');
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('post_validation', 'Your post has been deleted successfully!');
    }

    public function comment(PostRequest $request, PostRepository $postRepository, Post $post)
    {
        $validatedData = $request->validated();
        $comment = $postRepository->comment($validatedData, $post);
        return back()->with('comment_saved', 'Your comment has been added!');
    }

    public function reply(PostRequest $request, PostRepository $postRepository, Post $post, Comment $comment)
    {
        $validatedData = $request->validated();
        $replyComment = $postRepository->reply($validatedData, $post, $comment);
        return back()->with('comment_saved', 'Your reply has been added!');
    }
   
}