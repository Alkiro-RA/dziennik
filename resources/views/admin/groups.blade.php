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
                <div class="card-header">{{ __('Zarządzanie klasami') }}</div>

                <div class="card-body">
                    <h3>Lista klas</h3>
                    <a href="{{ route('admin.createGroup') }}" class="btn btn-success mb-3">Dodaj klasę</a>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nazwa klasy</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr>
                                <td>{{ $group->name }}</td>
                                <td>
                                    <a href="{{ route('admin.showStudents', $group->id) }}" class="btn btn-info btn-sm">Zobacz uczniów</a>
                                    <a href="{{ route('admin.assignTeacher', $group->id) }}" class="btn btn-success btn-sm">Przypisz nauczyciela</a>
                                    <a href="{{ route('admin.editGroup', $group->id) }}" class="btn btn-warning btn-sm">Edytuj</a>
                                    <form action="{{ route('admin.deleteGroup', $group->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Powrót panelu admina</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
