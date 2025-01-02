<h1>Uczniowie przypisani do grupy: {{ $group->name }}</h1>
<button onclick="location.href='{{ route('teacher.subjects') }}'">Powrót</button>


<h1>Lista Uczniów</h1>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Imię ucznia</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <td>
                    {{ $student->name }}
                </td>
                <td>
                    <form method="GET" action="{{ route('teacher.grades', $student->id) }}">
                        <input type="hidden" name="subjectId" value="{{ $subjectId }}">
                        <button type="submit">Wybierz</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>