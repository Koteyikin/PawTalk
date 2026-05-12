<?php

namespace App\Http\Controllers;

use App\Models\Bookmarks;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
        ]);

        $existing = Bookmarks::where('user_id', auth()->id())
            ->where('article_id', $request->article_id)
            ->first();

        if ($existing) {
            $existing->delete();
            $bookmarked = false;
        } else {
            Bookmarks::create([
                'user_id'    => auth()->id(),
                'article_id' => $request->article_id,
            ]);
            $bookmarked = true;
        }

        if ($request->wantsJson()) {
            return response()->json(['bookmarked' => $bookmarked]);
        }

        return back();
    }
}
