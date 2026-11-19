@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
<section class="hero">
    <div>
        <div class="eyebrow" style="color:#9fc5f5">Ruang ide dan inspirasi</div>
        <h1>Temukan cerita, bagikan pengetahuan.</h1>
        <p>RuangBaca adalah tempat untuk membaca gagasan baru dan menerbitkan tulisan yang bermanfaat bagi banyak orang.</p>
        @auth
            <a class="btn btn-blue" href="{{ route('articles.create') }}">＋ Tulis Artikel</a>
            <a class="btn" style="background:#fff;color:#172d4b;margin-left:7px" href="{{ route('articles.index') }}">Kelola Artikel</a>
        @else
            <a class="btn btn-blue" href="{{ route('register') }}">Mulai Menulis</a>
            <a class="btn" style="background:#fff;color:#172d4b;margin-left:7px" href="{{ route('login') }}">Masuk</a>
        @endauth
    </div>
    <div class="hero-art"><div class="paper"><div class="eyebrow">Pilihan editor</div><h3 style="margin:12px 0 5px">Ide baik layak dibagikan.</h3><div class="paper-line"></div><div class="paper-line"></div><div class="paper-line short"></div><div style="margin-top:20px;font-size:12px;color:#718096">Baca · Belajar · Berkarya</div></div></div>
</section>

<div class="section-head">
    <div><div class="eyebrow">Dari komunitas</div><h2 style="margin:5px 0">Artikel terbaru</h2><p class="muted" style="margin:0">Jelajahi tulisan terbaru dari para penulis.</p></div>
    @auth <a href="{{ route('articles.index') }}">Lihat semua artikel →</a> @endauth
</div>

@if($articles->isNotEmpty())
<div class="grid">
    @foreach($articles as $article)
    <article class="card">
        <a href="{{ route('articles.show', $article) }}"><img class="article-image" src="{{ $article->image_url }}" alt="Gambar {{ $article->title }}" loading="lazy"></a>
        <div class="card-body">
            <div class="meta">{{ $article->created_at->format('d M Y') }} · {{ $article->user->name }}</div>
            <h3 class="article-title"><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h3>
            <p class="excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($article->body), 115) }}</p>
            <a href="{{ route('articles.show', $article) }}" style="font-weight:700;font-size:13px">Baca selengkapnya →</a>
        </div>
    </article>
    @endforeach
</div>
@else
<div class="panel empty"><div class="empty-icon">📚</div><h3>Belum ada artikel</h3><p class="muted">Jadilah orang pertama yang membagikan tulisan.</p>@auth<a class="btn" href="{{ route('articles.create') }}">Tulis Artikel</a>@endauth</div>
@endif
@endsection
