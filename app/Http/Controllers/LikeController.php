<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\comments;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'type' => 'required|in:article,comment',
            'id'   => 'required|integer',
        ]);

        // Определяем модель
        $model = match($request->type) {
            'article' => Article::findOrFail($request->id),
            'comment' => comments::findOrFail($request->id),
        };

        $userId = auth()->id();

        // Ищем существующий лайк
        $existing = $model->likes()
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            // Уже лайкнул — убираем
            $existing->delete();
            $liked = false;
        } else {
            // Ещё не лайкал — ставим
            $model->likes()->create(['user_id' => $userId]);
            $liked = true;
        }

        $count = $model->likes()->count();

        // Если AJAX — возвращаем JSON
        if ($request->wantsJson()) {
            return response()->json([
                'liked' => $liked,
                'count' => $count,
            ]);
        }

        return back();
    }
}
