<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Wyświetl panel admina.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Pobranie wszystkich użytkowników
        $users = User::all();

        // Przekazanie użytkowników do widoku
        return view('admin.index', compact('users'));
    }

    /**
     * Wyświetl formularz do tworzenia nowego użytkownika.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Zapisz nowego użytkownika.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3|confirmed',
            'role' => 'required|string|in:uczen,nauczyciel,admin',
        ]);
        
        // Tworzenie nowego usera 
        $user = User::create([
            'name' => $validated['name'], // Przypisanie nazwy
            'email' => $validated['email'], // Przypisanie maila
            'password' => bcrypt($validated['password']), // Przypisanie hała
            'role' => $validated['role'], // Przypisanie roli
        ]);

        return redirect()->route('admin.index')->with('success', 'Utworzono nowego użytkownika!');
    }

    /**
     * wyświetlanie formularza edycji
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    /**
     * aktualizacja usera
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:uczen,nauczyciel,admin',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.index')->with('success', 'Zaktualizowano dane użytkownika.');
    }

    /**
     * Usunięcie usera
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Usunięto użytkownika.');
    }
    public function editRole($id)
    {
        $user = User::findOrFail($id);
        return view('admin.role', compact('user'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string|in:uczen,nauczyciel', 
    ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Rola użytkownika została zaktualizowana.');
    }

    public function createGroup()
{
    return view('admin.createGroup');
}

public function storeGroup(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:groups,name',
    ]);

    // Tworzenie nowej grupy
    \App\Models\Group::create([
        'name' => $request->name,
    ]);

    return redirect()->route('admin.index')->with('success', 'Dodano nową klasę!');
}


// widok klas
public function showGroups()
{
    // Pobranie wszystkich klas
    $groups = \App\Models\Group::all();

    return view('admin.groups', compact('groups'));
}

//usunięcie klasy
public function deleteGroup($id)
{
    $group = \App\Models\Group::findOrFail($id);
    $group->delete();

    return redirect()->route('admin.showGroups')->with('success', 'Klasa została usunięta.');
}

//edycja klasy
public function editGroup($id)
{
    $group = \App\Models\Group::findOrFail($id);

    return view('admin.editGroup', compact('group'));
}
public function updateGroup(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $group = \App\Models\Group::findOrFail($id);
    $group->update([
        'name' => $validated['name'],
    ]);

    return redirect()->route('admin.showGroups')->with('success', 'Klasa została zaktualizowana.');
}

// lista uczniów
public function showStudents($groupId)
{
    $students = \App\Models\User::where('group_id', $groupId)->where('role', 'uczen')->get();
    $teacher = \App\Models\User::where('group_id', $groupId)->where('role', 'nauczyciel')->first();

    $group = \App\Models\Group::findOrFail($groupId);

    return view('admin.showStudents', compact('students', 'teacher', 'group'));
}



//wyświetla formularz dodania nauczyciela
public function assignTeacher($groupId)
{
    $group = \App\Models\Group::findOrFail($groupId);

    $teachers = \App\Models\User::where('role', 'nauczyciel')->get();

    return view('admin.assignTeacher', compact('group', 'teachers'));
}

    // Przypisanie nauczyciela do klasy
    public function storeTeacher(Request $request, $groupId)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
        ]);
    
        $teacher = \App\Models\User::where('id', $request->teacher_id)
                                   ->where('role', 'nauczyciel') 
                                   ->firstOrFail();
    
        $teacher->group_id = $groupId;
        $teacher->save();
    
        return redirect()->route('admin.showGroups')->with('success', 'Nauczyciel został przypisany do klasy.');
    }
    
    public function showAddStudentForm($groupId)
{
    // Pobierz grupę po ID
    $group = \App\Models\Group::findOrFail($groupId);

    // Pobierz uczniów, którzy nie są przypisani do żadnej grupy
    $students = \App\Models\User::where('role', 'uczen')->whereNull('group_id')->get();

    return view('admin.addStudentToGroup', compact('group', 'students'));
}
public function addStudent(Request $request, $groupId)
{
    // Walidacja: sprawdzenie, czy uczniak o podanym ID istnieje
    $validated = $request->validate([
        'student_id' => 'required|exists:users,id',
    ]);

    // Znajdź ucznia po ID
    $student = \App\Models\User::find($validated['student_id']);

    // Przypisz ucznia do danej grupy
    $student->group_id = $groupId;
    $student->save();

    // Przekierowanie do listy uczniów tej grupy
    return redirect()->route('admin.showStudents', $groupId)->with('success', 'Uczeń został przypisany do klasy.');
}


}
