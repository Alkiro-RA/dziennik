@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Hasło:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Zaloguj</button>
    </form>
@endsection