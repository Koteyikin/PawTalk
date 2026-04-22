<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('profile.home');
    }
    public function store(RegisterRequest $request)
    {
        User::create($request->validated());

        return view('home');
    }
}
