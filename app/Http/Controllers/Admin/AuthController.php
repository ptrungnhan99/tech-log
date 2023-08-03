<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view("admin.login.login");
    }
    public function checkLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        if (Auth::attempt([
            'email' => $email,
            'password' =>  $password
        ])) {
            return redirect('/admin/post');
        } else {
            return redirect()->back()->with('alert', 'Login Failed !!!!');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
