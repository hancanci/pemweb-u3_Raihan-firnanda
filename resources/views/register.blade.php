@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="card">
        <h2>Register</h2>

        @if ($errors->any())
            <p style="color:#b91c1c;">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <p>
                <label>Nama</label><br>
                <input type="text" name="name" value="{{ old('name') }}" required style="width:100%; padding:6px;">
            </p>
            <p>
                <label>Email</label><br>
                <input type="email" name="email" value="{{ old('email') }}" required style="width:100%; padding:6px;">
            </p>
            <p>
                <label>Password</label><br>
                <input type="password" name="password" required style="width:100%; padding:6px;">
            </p>
            <button type="submit" style="padding:6px 16px;">Register</button>
        </form>

        <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
@endsection