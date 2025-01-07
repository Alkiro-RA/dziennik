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
    <h3>Przypisz nauczyciela do przedmiotu: {{ $subject->name }}</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.storeTeacherToSubject', $subject->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="teacher_id">Wybierz nauczyciela</label>
        <select name="teacher_id" id="teacher_id" class="form-control">
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Przypisz nauczyciela</button>
</form>

</div>
@endsection
