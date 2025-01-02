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
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:uczeń,nauczyciel',
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
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
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
            'role' => 'required|string|in:uczeń,nauczyciel', // Dopuszczalne role
    ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Rola użytkownika została zaktualizowana.');
    }
}
