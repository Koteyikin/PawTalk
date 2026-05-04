<?php

namespace App\Http\Controllers\article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleFunctionController extends Controller
{
    public function show($id)
    {
        $articles = Article::with(['author.aboutUser', 'category', 'tags', 'comments.author.aboutUser',])->findOrFail($id);
        $articles->increment('views_count');
        return view('articles.articles-show', compact('articles'));
    }

    public function store(Request $request)
    {
//        dd('store reached');
        $validated = $request->validate([
            'title' => 'required|max:255',
            'user_id' => 'required',
            'excerpt' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required',

            'tags' => 'required|array',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
//            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
            'status' => 'required',
            'reading_time' => 'nullable|integer',
            'views_count' => 'nullable|string',
        ]);
        // обработка картинки
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/articles'), $filename);
            $validated['image'] = 'articles/' . $filename;
        }

        // вытаскиваем теги
        $tags = $validated['tags'];
        unset($validated['tags']);

        // создаём статью
        $article = Article::create($validated);

        // привязываем теги
        $article->tags()->sync($tags);

        return redirect()->route('articles.index');
    }
}
