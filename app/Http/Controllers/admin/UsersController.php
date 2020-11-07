<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createuser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        
        try {
            $user = new User();
            $user['name'] = $request->name;
            $user['email'] = $request->email;
            $user['password'] = bcrypt($request->password);
            $user['role'] = $request->level;
            $user['remember_token'] = md5(time());
            $user->save();
            return redirect()->route('user.index')->with('success', 'Thêm mới thành công !');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('failed', $th->getMessage());
        }
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
        $user = User::find($id);
        return view('admin.edituser', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $user['name'] = $request->name;
            $user['email'] = $request->email;
            if ($request->password) {
                $user['password'] = bcrypt($request->password);
            }
            $user['role'] = $request->level;
            $user['remember_token'] = md5(time());
            $user->save();
            return redirect()->route('user.index')->with('success', 'Sửa thành công !');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('failed', $th->getMessage());
        }
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
            $user = User::find($request->delete_id);
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Xóa thành công !');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('failed', 'Xóa thất bại !');
        }
    }
}
