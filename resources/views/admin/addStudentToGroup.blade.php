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
    <h1>Dodaj ucznia do klasy: {{ $group->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<form action="{{ route('admin.addStudent', $group->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="student_id">Wybierz ucznia:</label>
        <select name="student_id" id="student_id" class="form-control" required>
            @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Dodaj ucznia do klasy</button>
</form>
</div>
@endsection
