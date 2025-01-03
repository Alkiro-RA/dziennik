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
    <h1>Lista uczniów w klasie: {{ $group->name }}</h1>

    @if($teacher)
        <div class="alert alert-info">
            <strong>Przypisany nauczyciel:</strong> {{ $teacher->name }} ({{ $teacher->email }})
        </div>
    @else
        <div class="alert alert-warning">
            <strong>Brak przypisanego nauczyciela dla tej klasy.</strong>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Imię i nazwisko</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
<a href="{{ route('admin.addStudentForm', $group->id) }}" class="btn btn-primary mb-3">Dodaj ucznia do klasy</a>




</div>
@endsection
