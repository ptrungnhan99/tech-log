<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.user_list', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'repassword' => 'required|same:password',
            'avatar' => 'required',
        ], [
            'repassword' => 'repassword is wrong',
        ]);
        $nameAvatar = '';
        if ($request->hasfile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                $file = $request->file('avatar');
                $nameAvatar = $file->getClientOriginalName();
                $file->move('public/images', $nameAvatar);
            }
        }
        $user = new User();
        $user->avatar = $nameAvatar;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = $request->is_admin;
        $n = $user->save();
        if ($n > 0) {
            return redirect('admin/user')->with('success', 'Thêm thành công');
        } else {
            return redirect()->back()->with('alert', 'Thêm không thành công');
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
        $user = User::find($id);
        return view('admin.user.user_edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $user = User::find($id);
        $nameAvatar = $user->avatar;
        if ($request->hasfile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                $file = $request->file('avatar');
                $nameAvatar = $file->getClientOriginalName();
                $file->move('public/images', $nameAvatar);
            }
        }
        $user->avatar = $nameAvatar;
        $user->name = $request->name;
        $user->is_admin = $request->is_admin;
        $n = $user->save();
        if ($n > 0) {
            return redirect('/admin/user')->with('success', 'Add Post Success');
        } else {
            return redirect()->back()->with('alert', 'Add Post Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Delete Success!!');
    }
}
