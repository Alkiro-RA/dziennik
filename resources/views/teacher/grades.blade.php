<h1>Oceny ucznia {{ $student->name }} </h1>
<h2>Przedmiot {{ $subject->name }}</h2>
<button onclick="location.href='{{ route('teacher.subjects') }}'">Powrót</button>
<!-- dodaj parametr groupId i zrób wracanie do grupy -->

<h1>Lista Ocen</h1>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Ocena</th>
            <th>Komentarz</th>
            <th>Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $grade)
            <tr>
                <td>
                    {{ $grade->grade }}
                </td>
                <td>
                    {{ $grade->comment }}
                </td>
                <td>
                <form method="GET" action="{{ route('teacher.editGrade', $grade->id) }}">
                        <button type="submit">Edytuj ocenę</button>
                    </form>
                    <!-- tu odpalanie mini formularza do edycji oceny? -->
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<form method="POST" action="{{ route('teacher.newGrade') }}">
    @csrf
    <input type="hidden" name="studentId" value="{{ $student->id }}">
    <input type="hidden" name="subjectId" value="{{ $subject->id }}">
    <button type="submit">Nowa ocena</button>
</form>