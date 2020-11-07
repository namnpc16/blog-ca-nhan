<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\EditCategoriesRequest;
use App\Categories;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::all();
        return view('admin.categories', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $category = new Categories();
        $category['name'] = $request->name;
        $category['status'] = $request->status;
        $category['slug'] = Str::slug($request->name, '-');
        $category->save();
        
        return back()->with('success', 'Thêm danh mục thành công !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::find($id);
        $categories = Categories::all();
        return view('admin.editcategory', ['category' => $category, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCategoriesRequest $request, $id)
    {
        $category = Categories::find($id);
        $category['name'] = $request->name;
        $category['status'] = $request->status;
        $category['slug'] = Str::slug($request->name, '-');
        $category->save();
        return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công !');
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
            $category = Categories::find($request->delete_id);
            $num = Categories::find($request->delete_id)->posts->count();          
            if($num > 0){
                throw new Exception('Dạnh mục đang thuộc '.$num.' bài viết không thể xóa !');
            }
            $category->delete();
            return back()->with('success', 'Xóa danh mục thành công !');
        } catch (\Throwable $th) {
            return back()->with('failed', $th->getMessage());
        }
    }
}
