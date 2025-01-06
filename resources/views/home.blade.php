@extends('layouts.app')

@section('content')
    @if(Auth::check())
    
        <h1>Witaj, {{ Auth::user()->name }}!</h1>

        @if(Auth::user()->role == 'uczen')
        
            <h2>Panel ucznia</h2>
            <button onclick="location.href='{{ route('student.showGrades',) }}'">Przejdź do listy przedmiotów</button>
            
        @elseif(Auth::user()->role == 'nauczyciel')
        
            <h2>Panel nauczyciela</h2>
            <button onclick="location.href='{{ route('teacher.subjects') }}'">Przejdź do listy przedmiotów</button>
        
        @elseif(Auth::user()->role == 'admin')
        
            <h2>Panel administratora</h2>
            <button onclick="location.href='{{ route('admin.index') }}'">Przejdź do panelu administratora</button>
        
        @endif
    
    @else
        <h1>Witaj w dzienniku. Zaloguj się lub załóż konto</h1>
    @endif
@endsection