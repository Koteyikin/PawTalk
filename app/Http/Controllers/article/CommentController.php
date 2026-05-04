<?php

namespace App\Http\Controllers\article;

use App\Http\Controllers\Controller;
use App\Models\comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {

    }
    public function store(Request $request)
    {
        $comment = $request->validate([
            'article_id' => 'required',
            'user_id' => 'required',
            'parent_id' => 'nullable',
            'body' => 'required',
            'is_approved' => 'nullable',
        ]);

        comments::create($comment);
        return redirect()->back();
    }
}
