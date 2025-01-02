<h1>Dodaj nową ocenę dla ucznia</h1>

<form method="POST" action="{{ route('teacher.storeGrade') }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ $studentId }}">
    <input type="hidden" name="subject_id" value="{{ $subjectId }}">

    <label for="grade">Ocena:</label>
    <input type="text" id="grade" name="grade" required>

    <label for="comment">Komentarz:</label>
    <textarea id="comment" name="comment" rows="4"></textarea>

    <button type="submit">Zapisz ocenę</button>
</form>
