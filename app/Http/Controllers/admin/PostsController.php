<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\PostEditRequest;
use App\Posts;
use App\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::paginate(20);
        return view('admin.posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view('admin.createpost', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = new Posts();
        $post['title'] = $request->title;
        $post['slug'] = Str::slug($request->title.' '.time(), '-');

        $img = $request->file('img');
        $new_img = time().$img->getClientOriginalName();

        $img->move(storage_path('app/public/photos/image'), $new_img);
        $post['author'] = $request->author;
        $post['status'] = $request->status;
        $post['description'] = $request->description;
        $post['img'] = $new_img;
        $post->save();
        $post->categories()->attach($request->category_id);

        return redirect()->route('post.index')->with('success', 'Thêm mới bài viết thành công !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::all();
        $post = Posts::find($id);
        return view('admin.editpost', ['categories' => $categories, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditRequest $request, $id)
    {
        $post = Posts::find($id);
        $post['title'] = $request->title;
        $post['slug'] = Str::slug($request->title, '-');
        $post['author'] = $request->author;
        $post['status'] = $request->status;
        $post['description'] = $request->description;
        $post->categories()->sync($request->category_id);

        if ($request->file('img')) {
            unlink(storage_path('app/public/photos/image/').$post['img']);
            $img = $request->file('img');
            $new_img = time().$img->getClientOriginalName();
            $img->move(storage_path('app/public/photos/image'), $new_img);
            $post['img'] = $new_img;
        }

        $post->save();
        return redirect()->route('post.index')->with('success', 'Sửa bài viết thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $post = Posts::find($request->delete_id);

            
            $post->categories()->detach();
            
            unlink(storage_path('app/public/photos/image/').$post['img']);
            $post->delete();
            
            return redirect()->route('post.index')->with('success', 'Xóa bài viết thành công !');
        } catch (\Throwable $th) {
            return redirect()->route('post.index')->with('failed', 'Xóa bài viết thất bại !');
        }
    }
}
