<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->route('home.index');
        } else {
            return back()->withErrors([
                'error' => 'Неверный логин или пароль',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
