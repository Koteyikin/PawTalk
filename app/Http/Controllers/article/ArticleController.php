<?php

namespace App\Http\Controllers\article;

use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.articles');
    }
}
