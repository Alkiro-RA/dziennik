@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodaj przedmiot</h1>

    <!-- Wyświetlenie błędów walidacji -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formularz dodania przedmiotu -->
    <form action="{{ route('admin.storeSubject') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nazwa przedmiotu</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Podaj nazwę przedmiotu" required>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj</button>
        <a href="{{ route('admin.subjects') }}" class="btn btn-secondary">Powrót</a>
    </form>
</div>
@endsection
