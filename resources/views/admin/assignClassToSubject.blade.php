@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Przypisz klasę do przedmiotu: {{ $subject->name }}</h3>
    
    <form action="{{ route('admin.assignClassToSubject', $subject->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="group_id">Wybierz klasę</label>
            <select name="group_id" id="group_id" class="form-control" required>
                <option value="">Wybierz klasę</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Przypisz klasę</button>
    </form>
</div>
@endsection
