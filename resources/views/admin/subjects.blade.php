@extends('layouts.app')

@section('content')
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
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">Brak przedmiotów w bazie danych.</td>
        </tr>
    @endforelse
</tbody>
    </table>
</div>
@endsection
