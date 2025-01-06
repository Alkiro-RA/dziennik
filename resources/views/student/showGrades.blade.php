@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Przedmioty i Oceny</h1>

        <!-- Formularz wyboru przedmiotu -->
        <form method="GET" action="{{ route('student.showGrades') }}">
            <div class="form-group">
                <label for="subject">Wybierz przedmiot:</label>
                <select name="subject_id" id="subject" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Wszystkie przedmioty --</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $selectedSubjectId == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Wyświetlanie ocen -->
        <h2>Oceny</h2>
        @if($grades->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Przedmiot</th>
                        <th>Ocena</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grades as $grade)
                        <tr>
                            <td>{{ $grade->subject->name }}</td>
                            <td>{{ $grade->grade }}</td>
                            <td>{{ $grade->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Brak ocen dla wybranego przedmiotu.</p>
        @endif
    </div>
@endsection
