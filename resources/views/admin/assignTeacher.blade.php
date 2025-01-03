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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Przypisz nauczyciela do klasy: ') }} {{ $group->name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.storeTeacher', $group->id) }}">
                        @csrf

                        <div class="form-group">
                            <label for="teacher_id">Wybierz nauczyciela</label>
                            <select name="teacher_id" id="teacher_id" class="form-control" required>
                                <option value="">-- Wybierz nauczyciela --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Przypisz nauczyciela</button>
                        <a href="{{ route('admin.showGroups') }}" class="btn btn-secondary mt-3">Powrót</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
