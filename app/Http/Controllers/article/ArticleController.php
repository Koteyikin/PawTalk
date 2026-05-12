<?php

namespace App\Http\Controllers\article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::all();
        $totalViews = Article::sum('views_count');
        $sort = $request->get('sort', 'new');
        $article = Article::where('status', 'published')->when($sort === 'new', function ($q) {
            $q->orderBy('created_at', 'desc');
        })->when($sort === 'popular', function ($q) {
            $q->orderBy('views_count', 'desc');
        })->when($sort === 'comments', function ($q) {
            $q->orderBy('comments_count', 'desc');
        })->paginate(5);
        $user = auth()->user();
        $profileFull = $user->profileFull();
        return view('articles.articles', compact('user', 'profileFull', 'articles', 'totalViews', 'article', 'sort'));
    }
}
