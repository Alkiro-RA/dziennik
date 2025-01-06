<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Grade;

class GradeController extends Controller
{
    public function showGrades(Request $request)
    {
        $user = Auth::user(); // Pobierz zalogowanego użytkownika

        $groupId = $user->group_id;

        // Pobierz przedmioty powiązane z group_id
        $subjects = Subject::whereHas('groups', function ($query) use ($groupId) {
            $query->where('group_id', $groupId);
        })->get();

        // Pobierz ID wybranego przedmiotu
        $selectedSubjectId = $request->get('subject_id');

        // Pobierz oceny
        $grades = Grade::query()
            ->where('user_id', $user->id)
            ->when($selectedSubjectId, function ($query) use ($selectedSubjectId) {
                $query->where('subject_id', $selectedSubjectId);
            })
            ->get();

        return view('student.showGrades', compact('subjects', 'grades', 'selectedSubjectId'));
    }
}