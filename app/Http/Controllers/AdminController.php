<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    function formLogin()
    {
        return view('login.login');
    }

    function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $admin = Admin::where(['username' => $request->username, 'password' => $request->password])->count();
        if ($admin > 0) {
            $adminData = Admin::where(['username' => $request->username, 'password' => $request->password])->get();
            session(['adminData' => $adminData]);
            return redirect(route('admin.dashboard'));
        } else {
            return redirect(route('admin.form'))->with('msg', 'Invalid Username/Password!!');
        }
    }

    function dashboard()
    {
        return view('admin.dashboard');
    }

    function logout()
    {
        session()->forget(['adminData']);
        return redirect(route('admin.form'));
    }
}
