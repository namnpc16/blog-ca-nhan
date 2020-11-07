<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Posts;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;

class ViewPostHandler
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $post;
    public $session;

    public function __construct(Posts $posts)
    {
        if(!$this->isPostView($posts)){
            $posts->increment('view_count');
            $this->storePost($posts);
        }else {

            if (!$this->cleanExpiredViews($posts)) {
                
                $posts->increment('view_count');
                Session::flush();
                $this->storePost($posts);
            }
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function isPostView($post)
    {
        $sesion = Session::get('viewed_posts', []); 
        return array_key_exists($post->id, $sesion);
    }

    public function storePost($post)
    {
        $key = 'viewed_posts.'.$post->id;
        Session::push($key, time());
    }

    public function cleanExpiredViews($posts)
    {
        $time = time();
        $throwTime =360;

        $arr = Session::get('viewed_posts')[$posts->id];

        return ($arr[0] + $throwTime) > $time;
        // $a = array_filter($arr, function ($timestamp)
        // {
        //     return $timestamp;
        // });
        // return $a[0] + 3600;
        // return array_filter($arr, function ($timestamp) use ($time, $throwTime)
        // {
        //     return ($timestamp );
        // });
    }
    
}
