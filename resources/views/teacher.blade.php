<!-- resources/views/teacher.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Witaj w panelu nauczyciela!</h1>
    <p>Tu możesz zarządzać dodać oceny.</p>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger mt-3">Wyloguj się</button>
    </form>
</div>
@endsection
