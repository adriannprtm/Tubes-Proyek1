<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $users = [
        'admin' => 'password123',
        'user' => 'userpass'
    ];

    public function showLoginForm()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (isset($this->users[$credentials['username']]) && $this->users[$credentials['username']] === $credentials['password']) {
            Session::put('username', $credentials['username']);
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'credentials' => 'Invalid username or password.',
        ]);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login_form');
    }
}

