<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Группируем по категории
        $faqs = Faq::published()
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        return view('faq.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'name'     => 'nullable|string|max:255',
            'email'    => 'nullable|email|max:255',
        ]);

        FaqQuestion::create([
            'user_id'  => auth()->id(),
            'name'     => auth()->check() ? auth()->user()->aboutUser->name ?? auth()->user()->nickname : $request->name,
            'email'    => auth()->check() ? auth()->user()->email : $request->email,
            'question' => $request->question,
            'status'   => 'new',
        ]);

        return back()->with('success', 'Ваш вопрос отправлен! Мы ответим в ближайшее время.');
    }
}
