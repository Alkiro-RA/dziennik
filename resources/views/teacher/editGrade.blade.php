<h1>Edytuj ocenę</h1>
<form method="POST" action="{{ route('teacher.updateGrade', $grade->id) }}">
    @csrf
    @method('PUT')
    <label for="grade">Ocena:</label>
    <input type="text" name="grade" id="grade" value="{{ $grade->grade }}" required>
    <label for="comment">Komentarz:</label>
    <textarea name="comment" id="comment">{{ $grade->comment }}</textarea>
    <button type="submit">Zapisz zmiany</button>
</form>