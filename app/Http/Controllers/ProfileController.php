<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileCreateRequest;
use App\Models\AboutUser;
use App\Models\Gender;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $gender = Gender::all();
        $status = Status::all();
        return view('profile.home', compact('gender', 'status'), ['about' => auth()->user()->aboutUser]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'contact' => 'required|string|max:255',
            'gender_id' => 'nullable|integer|exists:genders,id',
            'status_id' => 'nullable|integer|exists:statuses,id',
            'interests' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'description' => 'nullable|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
            'animal_id' => 'required|integer|exists:animals,id',
        ]);

        if ($request->files->get('avatar')) {
            $file = $request->files->get('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/img'), $filename);
            $validated['avatar'] = 'img/' . $filename;
        } else {
            $validated['avatar'] = null;
        }

        AboutUser::create($validated);
        return redirect()->back();
//        dd($request->all());
    }
}
