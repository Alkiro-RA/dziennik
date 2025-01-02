<h1>Grupy przypisane do przedmiotu: {{ $subject->name }}</h1>
<button onclick="location.href='{{ route('teacher.subjects') }}'">Powrót</button>

<h1>Lista Nauczanych Grup</h1>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Nazwa Grupy</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groups as $group)
            <tr>
                <td>
                    {{ $group->name }}
                </td>
                <td>
                    <form method="GET" action="{{ route('teacher.students', $group->id) }}">
                        <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                        <button type="submit">Wybierz</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>