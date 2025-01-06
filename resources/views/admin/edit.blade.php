@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Auth;

    // Sprawdzenie, czy użytkownik jest zalogowany i ma uprawnienia administratora
    if (!Auth::check() || Auth::user()->role != "admin") {
        echo '
        <div class="container">
            <h1>Brak dostępu</h1>
            <p>Nie masz uprawnień, aby wyświetlić tę stronę.</p>
            <a href="' . url('/home') . '" class="btn btn-secondary mt-3">Powrót na stronę główną</a>
        </div>';
        return;
    }
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edytuj użytkownika') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nazwa</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Adres e-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Nowe hasło</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Potwierdź hasło</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        
                        <div class="form-group">
                            <label for="role">Rola użytkownika</label>
                            <select class="form-control" id="role" name="role">
                                <option value="uczen" {{ $user->role == 'uczen' ? 'selected' : '' }}>Uczeń</option>
                                <option value="nauczyciel" {{ $user->role == 'nauczyciel' ? 'selected' : '' }}>Nauczyciel</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Zaktualizuj dane</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection