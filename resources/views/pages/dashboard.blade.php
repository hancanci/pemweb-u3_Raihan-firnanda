@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="eyebrow">Area pengguna</div>
<h1 style="margin:5px 0 8px">Selamat datang, {{ $user->name }}!</h1>
<p class="muted">Berikut ringkasan aktivitas dan artikel terbaru di RuangBaca.</p>

<div class="stats">
    <div class="stat"><span>Total artikel di portal</span><strong>{{ $totalArticles }}</strong><span>Semua tulisan yang diterbitkan</span></div>
    <div class="stat"><span>Artikel milik kamu</span><strong>{{ $myArticles }}</strong><span>Tulisan dari akun kamu</span></div>
    <div class="stat"><span>Status akun</span><strong style="font-size:22px;margin:7px 0">Aktif</strong><span>{{ $user->email }}</span></div>
</div>

<div class="toolbar"><div><h2 style="margin:0 0 4px">Aktivitas terbaru</h2><p class="muted" style="margin:0">Artikel yang baru diterbitkan di portal.</p></div><a class="btn" href="{{ route('articles.create') }}">＋ Artikel Baru</a></div>
<div class="panel">
    @forelse($latestArticles as $article)
    <div style="display:flex;gap:15px;align-items:center;padding:13px 0;border-bottom:1px solid var(--line)">
        <img src="{{ $article->image_url }}" alt="" style="width:76px;height:62px;object-fit:cover;border-radius:9px">
        <div style="flex:1;min-width:0"><a href="{{ route('articles.show',$article) }}" style="font-weight:700;color:var(--navy)">{{ $article->title }}</a><div class="meta">{{ $article->user->name }} · {{ $article->created_at->format('d M Y') }}</div></div>
        <a class="btn btn-light btn-small" href="{{ route('articles.show',$article) }}">Buka</a>
    </div>
    @empty
    <div class="empty"><h3>Belum ada aktivitas</h3><p class="muted">Mulai dengan menerbitkan artikel pertamamu.</p><a class="btn" href="{{ route('articles.create') }}">Tulis Artikel</a></div>
    @endforelse
</div>
@endsection
