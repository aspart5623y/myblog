<?php

namespace App\Listeners;

use App\Models\PostViews;
use App\Events\PostViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ViewedPostListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostViewed $event)
    {
        $post = $event->post;
        $post_id = $event->post->id;
        $user_id = auth()->user()->id;
        
        
        $viewedPost = PostViews::where('post_id', $post_id)
                ->where('user_id', $user_id)->first();

        if ($viewedPost === null) {
            // dd($post->views());
            $post->views()->attach($user_id);
        }

    }
}
