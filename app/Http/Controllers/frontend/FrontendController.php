<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Posts;
use App\Categories;
use Illuminate\Http\Request;
use App\Events\ViewPostHandler;

class FrontendController extends Controller
{
    public function home()
    {
        $posts = Posts::paginate(10);
        
        return view('frontend.index', ['posts' => $posts]);
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function standart($slug)
    {
        $post = Posts::where('slug', $slug)->first();
        event(new ViewPostHandler($post));
        return view('frontend.singlestandard', ['post' => $post]);
    }

    public function category($slug)
    {
        $category_slug = Categories::where('slug', $slug)->get()[0]->id;
        $category = Categories::find($category_slug);
        $danh = $category->posts()->paginate(10);
        
        return view('frontend.categoryposts', ['category' => $category, 'danh' => $danh]);
    }
}
