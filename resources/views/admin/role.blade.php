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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Zmień Rolę Użytkownika</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="role">Rola</label>
                            <select name="role" id="role" class="form-control">
                                <option value="uczeń" {{ $user->role === 'uczeń' ? 'selected' : '' }}>Uczeń</option>
                                <option value="nauczyciel" {{ $user->role === 'nauczyciel' ? 'selected' : '' }}>Nauczyciel</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Zaktualizuj</button>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Anuluj</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
