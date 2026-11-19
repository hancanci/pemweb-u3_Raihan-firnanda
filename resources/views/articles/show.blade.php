@extends('layouts.app')
@section('title', $article->title)
@section('content')
<div style="max-width:850px;margin:0 auto">
    <a href="{{ url()->previous() }}" class="meta">← Kembali</a>
    <article class="panel" style="margin-top:16px;padding:clamp(20px,5vw,48px)">
        <div class="eyebrow">Artikel komunitas</div>
        <h1 style="font-size:clamp(28px,4vw,40px);margin:10px 0">{{ $article->title }}</h1>
        <div class="meta">Ditulis oleh <strong>{{ $article->user->name }}</strong> · {{ $article->created_at->format('d M Y') }}</div>
        <img class="detail-image" src="{{ $article->image_url }}" alt="Gambar {{ $article->title }}">
        <div class="detail-body">{!! nl2br(e($article->body)) !!}</div>
        <hr style="border:0;border-top:1px solid var(--line);margin:30px 0">
        <div class="actions">
            <a class="btn btn-light" href="{{ route('articles.index') }}">Artikel lainnya</a>
            @auth @if($article->user_id === auth()->id())<a class="btn" href="{{ route('articles.edit',$article) }}">Edit Artikel</a>@endif @endauth
        </div>
    </article>
</div>
@endsection