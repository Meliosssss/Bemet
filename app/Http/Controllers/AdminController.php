<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function check_login(Request $req)
    {
        $req->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5'
        ]);

        $data = $req->only('email', 'password');

        $check = auth()->attempt($data);
        if ($check) {
            return redirect()->route('admin.index')->with('success', 'Login successfully');
        }
        return back()->with('error', 'Email or password is incorrect');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login')->with('success', 'Logout successfully');
    }
}
