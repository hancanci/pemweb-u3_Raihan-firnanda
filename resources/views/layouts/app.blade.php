<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RuangBaca') · RuangBaca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--navy:#172d4b;--blue:#3978c6;--ink:#202b3c;--muted:#718096;--line:#e5eaf1;--paper:#f5f7fb;--white:#fff;--green:#16794b;--red:#b42318}
        *{box-sizing:border-box} body{margin:0;background:var(--paper);color:var(--ink);font-family:'DM Sans',sans-serif;line-height:1.6}
        a{color:var(--blue);text-decoration:none}a:hover{color:var(--navy)}
        .container{width:min(1120px,calc(100% - 40px));margin:auto}
        .topbar{background:var(--white);border-bottom:1px solid var(--line);position:sticky;top:0;z-index:20}
        .nav{min-height:76px;display:flex;align-items:center;gap:28px}
        .brand{font:800 22px 'Manrope',sans-serif;color:var(--navy);letter-spacing:-.8px}
        .brand-mark{display:inline-grid;place-items:center;background:var(--navy);color:#fff;width:32px;height:32px;border-radius:10px;margin-right:8px;font-size:16px}
        .nav-links{display:flex;align-items:center;gap:8px}.nav-links a{padding:9px 13px;border-radius:9px;color:#586579;font-weight:600;font-size:14px}
        .nav-links a.active,.nav-links a:hover{background:#edf3fb;color:var(--navy)}
        .nav-right{margin-left:auto;display:flex;align-items:center;gap:12px}.user-chip{font-size:13px;color:var(--muted)}
        .main{padding:38px 0 64px;min-height:75vh}
        h1,h2,h3,h4{font-family:'Manrope',sans-serif;color:var(--navy);line-height:1.25;margin-top:0}
        h1{font-size:clamp(30px,4vw,46px);letter-spacing:-1.4px}h2{font-size:25px}h3{font-size:18px}
        p{margin-top:0}.muted{color:var(--muted)}.eyebrow{text-transform:uppercase;letter-spacing:1.7px;color:var(--blue);font-size:11px;font-weight:800}
        .hero{background:var(--navy);color:#fff;border-radius:22px;padding:54px;display:grid;grid-template-columns:1.3fr .7fr;gap:28px;align-items:center;overflow:hidden}
        .hero h1{color:#fff;max-width:620px;margin:10px 0 14px}.hero p{color:#d4dfed;max-width:560px}
        .hero-art{background:#243f62;border:1px solid #46617f;border-radius:18px;padding:26px;transform:rotate(2deg)}
        .hero-art .paper{background:#fff;color:var(--navy);border-radius:12px;padding:20px;box-shadow:0 15px 30px #0d1b2d55}
        .hero-art .paper-line{height:8px;border-radius:8px;background:#e6edf6;margin:12px 0}.hero-art .paper-line.short{width:65%}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;border:0;border-radius:10px;padding:11px 17px;font:700 14px 'DM Sans';cursor:pointer;background:var(--navy);color:#fff;transition:.18s}
        .btn:hover{background:#254a76;color:#fff;transform:translateY(-1px)}.btn-blue{background:var(--blue)}.btn-light{background:#edf3fb;color:var(--navy)}.btn-danger{background:#fff0ee;color:var(--red)}.btn-small{padding:7px 11px;font-size:12px}
        .section-head{display:flex;align-items:end;justify-content:space-between;gap:16px;margin:36px 0 18px}
        .grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:20px}
        .card{background:var(--white);border:1px solid var(--line);border-radius:16px;overflow:hidden;box-shadow:0 5px 18px #1b355008}
        .card-body{padding:20px}.article-image{width:100%;height:205px;object-fit:cover;background:#e8edf4;display:block}
        .article-title{font-size:18px;margin:8px 0}.article-title a{color:var(--navy)}.meta{font-size:12px;color:var(--muted)}
        .excerpt{font-size:14px;color:#59677a;margin:10px 0 14px}
        .panel{background:#fff;border:1px solid var(--line);border-radius:16px;padding:25px;box-shadow:0 5px 18px #1b355008}
        .stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:22px 0}.stat{padding:22px;background:#fff;border:1px solid var(--line);border-radius:15px}
        .stat strong{font:800 32px 'Manrope';color:var(--navy);display:block}.stat span{font-size:13px;color:var(--muted)}
        .form-control{width:100%;border:1px solid #d7deea;border-radius:10px;padding:12px 14px;font:14px 'DM Sans';background:#fff;color:var(--ink);outline:none}
        .form-control:focus{border-color:var(--blue);box-shadow:0 0 0 3px #3978c61a}
        label{display:block;font-weight:700;font-size:13px;margin:16px 0 7px;color:var(--navy)}
        textarea.form-control{resize:vertical;min-height:190px}.form-help{font-size:12px;color:var(--muted);margin-top:6px}
        .alert{padding:13px 16px;border-radius:11px;margin:16px 0;font-size:14px}.success{background:#eaf7ef;color:var(--green);border:1px solid #c9ead5}.error{background:#fff0ee;color:var(--red);border:1px solid #f5cfca}
        .searchbar{display:flex;gap:10px;max-width:520px}.searchbar .form-control{background:#fff}
        .toolbar{display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap;margin:20px 0}
        .pagination-wrap{margin-top:24px}.pagination{display:flex;justify-content:center;gap:6px;list-style:none;padding:0;flex-wrap:wrap}
        .pagination a,.pagination span{display:block;padding:8px 12px;background:#fff;border:1px solid var(--line);border-radius:8px;font-size:13px}
        .pagination .active span{background:var(--navy);color:#fff;border-color:var(--navy)}.pagination .disabled span{color:#aab3c0}
        .detail-image{width:100%;max-height:430px;object-fit:cover;border-radius:14px;margin:18px 0}.detail-body{font-size:16px;line-height:1.9;color:#3e4b5d;white-space:normal}
        .empty{text-align:center;padding:48px 20px}.empty-icon{font-size:36px;margin-bottom:10px}
        .footer{background:#fff;border-top:1px solid var(--line);padding:24px 0;color:var(--muted);font-size:12px}
        .inline{display:inline}.actions{display:flex;gap:8px;align-items:center;flex-wrap:wrap}
        @media(max-width:800px){.hero{grid-template-columns:1fr;padding:34px}.hero-art{display:none}.grid{grid-template-columns:repeat(2,minmax(0,1fr))}.stats{grid-template-columns:1fr 1fr}}
        @media(max-width:580px){.container{width:min(100% - 28px,1120px)}.nav{gap:10px;min-height:68px;flex-wrap:wrap;padding:12px 0}.nav-links{order:3;width:100%;overflow:auto}.nav-right{margin-left:auto}.user-chip{display:none}.main{padding-top:24px}.hero{padding:27px 22px;border-radius:16px}.grid{grid-template-columns:1fr}.stats{grid-template-columns:1fr}.section-head{align-items:start;flex-direction:column}.searchbar{width:100%}.searchbar .form-control{min-width:0}}
    </style>
    @stack('styles')
</head>
<body>
    @include('partials.nav')
    <main class="main">
        <div class="container">
            @if(session('success')) <div class="alert success">{{ session('success') }}</div> @endif
            @if($errors->any())
                <div class="alert error"><strong>Periksa kembali data berikut:</strong><ul style="margin:6px 0 0;padding-left:20px">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            @yield('content')
        </div>
    </main>
    <footer class="footer"><div class="container" style="display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap"><span>© {{ date('Y') }} RuangBaca · Portal Artikel</span><span>Dibangun dengan Laravel</span></div></footer>
    @stack('scripts')
</body>
</html>
