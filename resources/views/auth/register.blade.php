@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Imię:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Hasło:</label>
        <input type="password" name="password" id="password" required><br>

        <label for="role">Rola:</label>
        <select name="role" id="role" required>
            <option value="uczen">Uczeń</option>
            <option value="nauczyciel">Nauczyciel</option>
            <option value="admin">Admin</option>
        </select><br>

        <button type="submit">Zarejestruj</button>
    </form>
@endsection