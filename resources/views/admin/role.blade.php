@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Zmień Rolę Użytkownika</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="role">Rola</label>
                            <select name="role" id="role" class="form-control">
                                <option value="uczeń" {{ $user->role === 'uczeń' ? 'selected' : '' }}>Uczeń</option>
                                <option value="nauczyciel" {{ $user->role === 'nauczyciel' ? 'selected' : '' }}>Nauczyciel</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Zaktualizuj</button>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Anuluj</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
