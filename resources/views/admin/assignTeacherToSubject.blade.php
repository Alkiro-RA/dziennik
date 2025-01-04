@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Przypisz nauczyciela do przedmiotu: {{ $subject->name }}</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.storeTeacherToSubject', $subject->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="teacher_id">Wybierz nauczyciela</label>
        <select name="teacher_id" id="teacher_id" class="form-control">
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Przypisz nauczyciela</button>
</form>

</div>
@endsection
