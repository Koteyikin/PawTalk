<?php

namespace App\Http\Controllers\article;

use App\Http\Controllers\Controller;

class ArticleFunctionController extends Controller
{
    public function index()
    {
        return view('articles.articles-show');
    }
}
