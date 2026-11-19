@extends('layouts.app')
@section('title', 'Edit Artikel')
@section('content')
<div style="max-width:780px;margin:0 auto">
    <div class="eyebrow">Perbarui tulisan</div><h1 style="margin:5px 0">Edit Artikel</h1><p class="muted">Periksa kembali isi artikel sebelum menyimpan perubahan.</p>
    <section class="panel">
        <form action="{{ route('articles.update',$article) }}" method="POST">
            @csrf @method('PUT')
            <label for="title">Judul Artikel</label>
            <input class="form-control" id="title" name="title" type="text" value="{{ old('title',$article->title) }}" maxlength="255" required>
            <label for="image">URL Gambar <span class="muted">(opsional)</span></label>
            <input class="form-control" id="image" name="image" type="url" value="{{ old('image',$article->image) }}" placeholder="https://contoh.com/gambar.jpg">
            <p class="form-help">Kosongkan URL gambar untuk menggunakan gambar bawaan.</p>
            <div id="preview-wrap" style="margin-top:12px"><img id="preview" src="{{ old('image',$article->image_url) }}" alt="Pratinjau gambar" style="width:100%;max-height:240px;object-fit:cover;border-radius:12px"></div>
            <label for="body">Isi Artikel</label>
            <textarea class="form-control" id="body" name="body" required>{{ old('body',$article->body) }}</textarea>
            <div class="form-help"><span id="count">0</span> karakter · Minimal 20 karakter.</div>
            <div class="actions" style="margin-top:24px"><button class="btn" type="submit">Simpan Perubahan</button><a class="btn btn-light" href="{{ route('articles.index') }}">Batal</a></div>
        </form>
    </section>
</div>
@endsection
@push('scripts')
<script>
const imageInput=document.getElementById('image'),preview=document.getElementById('preview'),wrap=document.getElementById('preview-wrap');
imageInput.addEventListener('input',()=>{if(imageInput.value){preview.src=imageInput.value;wrap.style.display='block'}else{wrap.style.display='none'}});
preview.addEventListener('error',()=>{wrap.style.display='none'});
const bodyInput=document.getElementById('body'),count=document.getElementById('count');const updateCount=()=>count.textContent=bodyInput.value.length;bodyInput.addEventListener('input',updateCount);updateCount();
</script>
@endpush
