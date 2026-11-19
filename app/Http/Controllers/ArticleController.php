<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('user')
            ->when($request->filled('search'), function ($query) use ($request) {
                $keyword = $request->search;
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                      ->orWhere('body', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $request->user()->articles()->create([
            'title' => $data['title'],
            'slug' => $this->makeSlug($data['title']),
            'body' => $data['body'],
            'image' => $data['image'] ?? null,
        ]);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function show(Article $article)
    {
        $article->load('user');
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorizeOwner($article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorizeOwner($article);
        $data = $this->validated($request);

        // Slug tidak diubah agar tautan artikel lama tetap berfungsi.
        $article->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'image' => $data['image'] ?? null,
        ]);

        return redirect()->route('articles.index')
            ->with('success', 'Perubahan artikel berhasil disimpan!');
    }

    public function destroy(Article $article)
    {
        $this->authorizeOwner($article);
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'min:4', 'max:255'],
            'body' => ['required', 'string', 'min:20'],
            'image' => ['nullable', 'url', 'max:255'],
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'title.min' => 'Judul minimal 4 karakter.',
            'body.required' => 'Isi artikel wajib diisi.',
            'body.min' => 'Isi artikel minimal 20 karakter.',
            'image.url' => 'Alamat gambar harus berupa URL yang valid.',
        ]);
    }

    private function makeSlug(string $title): string
    {
        return Str::slug($title) . '-' . Str::lower(Str::random(6));
    }

    private function authorizeOwner(Article $article): void
    {
        abort_unless($article->user_id === Auth::id(), 403,
            'Kamu tidak memiliki izin untuk mengubah artikel ini.');
    }
}
