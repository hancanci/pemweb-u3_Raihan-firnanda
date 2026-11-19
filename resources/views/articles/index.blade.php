@extends('layouts.app')
@section('title', 'Daftar Artikel')
@section('content')
<div class="section-head" style="margin-top:0">
    <div><div class="eyebrow">Perpustakaan tulisan</div><h1 style="margin:5px 0">Semua Artikel</h1><p class="muted" style="margin:0">Temukan, baca, dan kelola artikel komunitas.</p></div>
    <a class="btn" href="{{ route('articles.create') }}">＋ Tulis Artikel</a>
</div>
<div class="toolbar">
    <form class="searchbar" method="GET" action="{{ route('articles.index') }}">
        <input class="form-control" type="search" name="search" value="{{ request('search') }}" placeholder="Cari judul atau isi artikel...">
        <button class="btn btn-blue" type="submit">Cari</button>
        @if(request('search'))<a class="btn btn-light" href="{{ route('articles.index') }}">Reset</a>@endif
    </form>
    <span class="meta">Menampilkan {{ $articles->count() }} dari {{ $articles->total() }} artikel</span>
</div>
@if($articles->isNotEmpty())
<div class="grid">
    @foreach($articles as $article)
    <article class="card">
        <a href="{{ route('articles.show',$article) }}"><img class="article-image" src="{{ $article->image_url }}" alt="Gambar {{ $article->title }}" loading="lazy"></a>
        <div class="card-body">
            <div class="meta">{{ $article->created_at->format('d M Y') }} · {{ $article->user->name }}</div>
            <h3 class="article-title"><a href="{{ route('articles.show',$article) }}">{{ $article->title }}</a></h3>
            <p class="excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($article->body),100) }}</p>
            <div class="actions">
                <a class="btn btn-light btn-small" href="{{ route('articles.show',$article) }}">Baca</a>
                @if($article->user_id === auth()->id())
                    <a class="btn btn-small" href="{{ route('articles.edit',$article) }}">Edit</a>
                    <form class="inline" action="{{ route('articles.destroy',$article) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">@csrf @method('DELETE')<button class="btn btn-danger btn-small" type="submit">Hapus</button></form>
                @endif
            </div>
        </div>
    </article>
    @endforeach
</div>
<div class="pagination-wrap">{{ $articles->links('pagination::default') }}</div>
@else
<div class="panel empty"><div class="empty-icon">🔎</div><h3>Artikel tidak ditemukan</h3><p class="muted">Coba kata kunci lain atau buat artikel baru.</p><a class="btn" href="{{ route('articles.create') }}">＋ Tulis Artikel</a></div>
@endif
@endsection

