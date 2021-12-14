<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function addNew()
    {
        $categories = Category::all();
        return view('add-post', compact('categories'));
    }

    public function storePost(Request $request)
    {
        $title = $request->title;
        $body = $request->body;
        $category = $request->category;
        $user_id = $request->user_id;
        $image = $request->file('image');

        

        $this->validate($request, [
            'category' => 'required',
            'title' => 'required',
            'body' => 'required|min:100'
        ]);

        $post = new Post();

        if ($image != '') {
            // image
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('post-images'), $imageName);
            $post->image = $imageName;
        }


        $post->title = $title;
        $post->body = $body;
        $post->category_id = $category;
        $post->user_id = $user_id;

        if (Auth::user()->utype == 'admin') {
            $post->status = 'approved';
        } 

        $post->save();
        return redirect()->route('all.posts')
                ->with('post_validation', 'Your post has been created successfully!');
    }


    public function updateStatus($id)
    {
        $post = Post::find($id);
        $post->status = 'approved';
        $post->save();
        return back()->with('post_validation', 'Your post has been created successfully!');
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('edit-post', compact('post', 'categories'));
    }

    public function updatePost(Request $request)
    {
        $title = $request->title;
        $body = $request->body;
        $image = $request->image;
        $category = $request->category;
        $post_id = $request->post_id;
        $image = $request->file('image');

        
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required',
            'body' => 'required|min:100'
        ]);

        $post = Post::find($post_id);

        if ($image != '' && $post->image != '') {
            // image
            unlink(public_path('post-images') . '/' . $post->image);
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('post-images'), $imageName);
            $post->image = $imageName;
        } elseif ($image != '') {
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('post-images'), $imageName);
            $post->image = $imageName;
        }

        $post->title = $title;
        $post->body = $body;
        $post->category_id = $category;

        

        if (Auth::user()->utype == 'admin') {
            $post->status = 'approved';
        } 
        
        $post->save();
        return redirect()->route('all.posts')
                ->with('post_validation', 'Your post has been updated successfully!');
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return back()->with('post_validation', 'Your post has been deleted successfully!');
    }

    public function render()
    {
        if (Auth::user()->utype == 'admin') {
            $posts = Post::orderBy('created_at', 'DESC')->paginate(6);
        } else {
            $posts = Post::orderBy('created_at', 'DESC')->where('user_id', Auth::user()->id)->paginate(6);
        }
        return view('manage-posts', compact('posts'));
    }
}
