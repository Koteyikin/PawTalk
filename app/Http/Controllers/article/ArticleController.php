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
        $search     = $request->input('search');
        $sort       = $request->get('sort', 'new');
        $categoryId = $request->get('category'); // ← добавь

        $articles = Article::query()
            ->where('status', 'published')
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId); // ← добавь
            })
            ->when($sort === 'new', function ($q) {
                $q->orderBy('created_at', 'desc');
            })
            ->when($sort === 'popular', function ($q) {
                $q->orderBy('views_count', 'desc');
            })
            ->when($sort === 'comments', function ($q) {
                $q->withCount('comments')->orderBy('comments_count', 'desc');
            })
            ->paginate(5)
            ->withQueryString();

        $totalViews  = Article::sum('views_count');
        $user        = auth()->user();
        $profileFull = $user?->profileFull();

        return view('articles.articles', compact(
            'articles', 'totalViews', 'sort', 'user', 'profileFull', 'categoryId'
        ));
    }
}
