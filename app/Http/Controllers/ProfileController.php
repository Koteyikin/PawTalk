<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileCreateRequest;
use App\Models\AboutUser;
use App\Models\Gender;
use App\Models\Status;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $gender = Gender::all();
        $status = Status::all();
        return view('profile.home', compact('gender', 'status'));
    }

    public function create(ProfileCreateRequest $request)
    {
        AboutUser::create($request->validated());
        return redirect()->back();
    }
}
