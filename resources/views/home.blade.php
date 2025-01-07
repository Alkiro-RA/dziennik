@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(Auth::check())
        <div class="text-center">
            <h1 class="mb-4">Witaj, {{ Auth::user()->name }}!</h1>

            @if(Auth::user()->role == 'uczen')
                <h2 class="text-primary">Panel ucznia</h2>
                <button class="btn btn-outline-primary mt-3" onclick="location.href='{{ route('student.showGrades') }}'">
                    Przejdź do listy przedmiotów
                </button>
            
            @elseif(Auth::user()->role == 'nauczyciel')
                <h2 class="text-primary">Panel nauczyciela</h2>
                <button class="btn btn-outline-primary mt-3" onclick="location.href='{{ route('teacher.subjects') }}'">
                    Przejdź do listy przedmiotów
                </button>
            
            @elseif(Auth::user()->role == 'admin')
                <h2 class="text-primary">Panel administratora</h2>
                <button class="btn btn-outline-primary mt-3" onclick="location.href='{{ route('admin.index') }}'">
                    Przejdź do panelu administratora
                </button>
            
            @endif
        </div>
    @else
        <div class="text-center">
            <h1 class="mb-3">Witaj w dzienniku</h1>
            <p class="lead">Zaloguj się, aby uzyskać dostęp do systemu.</p>
        </div>
    @endif
</div>
@endsection
