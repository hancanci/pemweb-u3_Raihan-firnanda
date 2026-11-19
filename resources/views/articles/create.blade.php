@extends('layouts.app')
@section('title', 'Tulis Artikel')
@section('content')
<div style="max-width:780px;margin:0 auto">
    <div class="eyebrow">Kontribusi komunitas</div><h1 style="margin:5px 0">Tulis Artikel Baru</h1><p class="muted">Bagikan ide dan pengetahuanmu kepada pembaca.</p>
    <section class="panel">
        <form action="{{ route('articles.store') }}" method="POST">
            @csrf
            <label for="title">Judul Artikel</label>
            <input class="form-control" id="title" name="title" type="text" value="{{ old('title') }}" maxlength="255" required placeholder="Contoh: Mengenal Dasar Pemrograman Web">
            <label for="image">URL Gambar <span class="muted">(opsional)</span></label>
            <input class="form-control" id="image" name="image" type="url" value="{{ old('image') }}" placeholder="https://contoh.com/gambar.jpg">
            <p class="form-help">Gunakan tautan gambar publik yang diawali https://. Kosongkan jika ingin memakai gambar bawaan.</p>
            <div id="preview-wrap" style="display:none;margin-top:12px"><img id="preview" alt="Pratinjau gambar" style="width:100%;max-height:240px;object-fit:cover;border-radius:12px"></div>
            <label for="body">Isi Artikel</label>
            <textarea class="form-control" id="body" name="body" required placeholder="Mulai tulis artikel kamu di sini...">{{ old('body') }}</textarea>
            <div class="form-help"><span id="count">0</span> karakter · Minimal 20 karakter.</div>
            <div class="actions" style="margin-top:24px"><button class="btn" type="submit">Terbitkan Artikel →</button><a class="btn btn-light" href="{{ route('articles.index') }}">Batal</a></div>
        </form>
    </section>
</div>
@endsection
@push('scripts')
<script>
const imageInput=document.getElementById('image'), preview=document.getElementById('preview'), wrap=document.getElementById('preview-wrap');
imageInput.addEventListener('input',()=>{if(imageInput.value){preview.src=imageInput.value;wrap.style.display='block'}else{wrap.style.display='none'}});
preview.addEventListener('error',()=>{wrap.style.display='none'});
const bodyInput=document.getElementById('body'), count=document.getElementById('count');
const updateCount=()=>count.textContent=bodyInput.value.length;bodyInput.addEventListener('input',updateCount);updateCount();
</script>
@endpush
