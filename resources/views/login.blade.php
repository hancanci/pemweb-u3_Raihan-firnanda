@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="card">
        <h2>Login</h2>

        @if ($errors->any())
            <p style="color:#b91c1c;">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <p>
                <label>Email</label><br>
                <input type="email" name="email" value="{{ old('email') }}" required style="width:100%; padding:6px;">
            </p>
            <p>
                <label>Password</label><br>
                <input type="password" name="password" required style="width:100%; padding:6px;">
            </p>
            <button type="submit" style="padding:6px 16px;">Login</button>
        </form>

        <p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
    </div>
@endsection