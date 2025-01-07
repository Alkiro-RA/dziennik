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
    <h3>Przypisz klasę do przedmiotu: {{ $subject->name }}</h3>
    
    <form action="{{ route('admin.assignClassToSubject', $subject->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="group_id">Wybierz klasę</label>
            <select name="group_id" id="group_id" class="form-control" required>
                <option value="">Wybierz klasę</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Przypisz klasę</button>
    </form>
</div>
@endsection
