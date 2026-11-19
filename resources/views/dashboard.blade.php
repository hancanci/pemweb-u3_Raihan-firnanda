@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card">
        <h2>Dashboard</h2>
        <p>Halo, {{ auth()->user()->name }}!</p>
        <p>Email: {{ auth()->user()->email }}</p>
    </div>
@endsection