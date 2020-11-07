<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;
use App\Posts;

class Filter
{

    private $session;
    private $id;
    public function __construct(Store $session, Posts $posts)
    {
        $this->session = $session;
        $this->id = $posts;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      
        $posts = $this->getViewedPosts();
        
        if (!is_null($posts))
        {
            
            $time = $this->cleanExpiredViews($posts);
            dd($time);
            // $this->storePosts($posts);
        }

        return $next($request);
    }


    private function getViewedPosts()
    {
        $session = Session::get('viewed_posts');
        return $session;
        // return $this->session->get('viewed_posts');
    }

    private function cleanExpiredViews($posts)
    {
        $time = time();

        // Let the views expire after one hour.
        $throttleTime = 3600;

        return array_filter($posts, function ($timestamp) use ($time, $throttleTime)
        {
            
            return $timestamp ;
        });
    }

    private function storePosts($posts)
    {
        $this->session->put('viewed_posts', $posts);
    }
}
