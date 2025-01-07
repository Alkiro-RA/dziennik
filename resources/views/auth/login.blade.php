@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 w-100" style="max-width: 400px;">
        <h2 class="text-center mb-4">Logowanie</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <!--e-mail-->
            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Wpisz e-mail" required>
            </div>

            <!--hasło-->
            <div class="mb-3">
                <label for="password" class="form-label">Hasło:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Wpisz hasło" required>
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Zaloguj</button>
            </div>
        </form>
    </div>
</div>
@endsection
