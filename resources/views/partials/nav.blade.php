<header class="topbar">
    <div class="container nav">
        <a class="brand" href="{{ route('home') }}"><span class="brand-mark">R</span>RuangBaca</a>
        <nav class="nav-links" aria-label="Navigasi utama">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            @auth
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') ? 'active' : '' }}">Artikel</a>
            @endauth
        </nav>
        <div class="nav-right">
            @auth
                <span class="user-chip">Halo, <strong>{{ auth()->user()->name }}</strong></span>
                <form method="POST" action="{{ route('logout') }}" class="inline">@csrf
                    <button class="btn btn-light btn-small" type="submit">Keluar</button>
                </form>
            @else
                <a class="btn btn-light btn-small" href="{{ route('login') }}">Masuk</a>
                <a class="btn btn-small" href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
    </div>
</header>
