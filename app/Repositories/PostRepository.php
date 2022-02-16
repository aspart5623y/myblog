<?php
namespace App\Repositories;

use App\Models\Post;
use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Support\Arr;

class PostRepository {
    public function create($data)
    {
        $post = new Post();
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->category_id = $data['category'];
        $post->user_id = auth()->user()->id;

        if (Arr::exists($data, 'image')) {
            $imageName = $this->imageHandler($data['image']);
            $post->image = $imageName;
        }
        
        if (auth()->user()->utype == 'admin') {
            $post->status = 'approved';
        }
        $post->save();

        if ($post) {
            return response()->json('success', 200);
        } else {
            return response()->json('Error saving data', 500);
        }
    }


    public function update($data, $post)
    {
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->category_id = $data['category'];
        $post->user_id = auth()->user()->id;

        if (Arr::exists($data, 'image')) {
            $imageName = $this->imageHandler($data['image']);
            $post->image = $imageName;
        }
        
        if (auth()->user()->utype == 'admin') {
            $post->status = 'approved';
        }
        $post->save();

        if ($post) {
            return response()->json('success', 200);
        } else {
            return response()->json('Error saving data', 500);
        }
    }


    private function imageHandler($image)
    {
        if ($image != '') {
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('post-images'), $imageName);
            return $imageName;
        }
    }


    public function comment($data, $post)
    {
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->comment = $data['comment'];
        $post->comments()->save($comment);

        return $post;
    }

    public function reply($data, $post, $comment)
    { 

        $reply = new Reply();
        $reply->user_id = auth()->user()->id;
        $reply->post_id = $post->id;
        $reply->reply = $data['reply'];
        $comment->reply()->save($reply);

        return $comment;
    }

}