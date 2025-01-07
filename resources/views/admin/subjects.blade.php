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
    <h1>Lista przedmiotów</h1>

    <!-- Wyświetlanie komunikatów -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Przycisk dodania przedmiotu -->
    <a href="{{ route('admin.createSubject') }}" class="btn btn-primary mb-3">Dodaj przedmiot</a>

    <!-- Wyświetlenie listy przedmiotów -->
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nazwa przedmiotu</th>
                <th>Nauczyciel</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
        @forelse($subjects as $subject)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subject->name }}</td>
                <td>
                    @if($subject->teachers->isNotEmpty())
                        @foreach($subject->teachers as $teacher)
                            <p>{{ $teacher->name }}</p>
                        @endforeach
                    @else
                        Brak nauczyciela
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.assignTeacherForm', $subject->id) }}" class="btn btn-info btn-sm">Przypisz nauczyciela</a>
                    <a href="{{ route('admin.showAssignClassToSubjectForm', $subject->id) }}" class="btn btn-warning btn-sm">Przypisz klasę</a>
                    <form action="{{ route('admin.deleteSubject', $subject->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć ten przedmiot?')">Usuń</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Brak przedmiotów w bazie danych.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Sekcja wyświetlania klas i przypisanych przedmiotów -->
    <h2 class="mt-5">Lista klas i przypisanych przedmiotów</h2>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nazwa klasy</th>
            <th>Przypisane przedmioty</th>
        </tr>
    </thead>
    <tbody>
    @forelse($groups as $group)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $group->name }}</td>
            <td>
                @if($group->subjects->isNotEmpty())
                    <ul>
                        @foreach($group->subjects as $subject)
                            <li>{{ $subject->name }}</li>
                        @endforeach
                    </ul>
                @else
                    Brak przypisanych przedmiotów
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">Brak klas w bazie danych.</td>
        </tr>
    @endforelse
    </tbody>
</table>

    <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Powrót panelu admina</a>    
</div>

@endsection
