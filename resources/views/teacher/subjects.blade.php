<h1>Przedmioty przypisane do Ciebie: {{ $teacher->name }}</h1>
<button onclick="location.href='{{ route('home') }}'">Powrót</button>

<h1>Lista Przedmiotów</h1>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Nazwa Przedmiotu</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->name }}</td>
                <td>
                    <form method="GET" action="{{ route('teacher.groups', $subject->id) }}">
                        <button type="submit">Wybierz</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>