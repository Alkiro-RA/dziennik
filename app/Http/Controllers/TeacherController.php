<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function showSubjects()
    {
        $teacher = Auth::user(); // pobierz zalogowanego użytkownika
        $subjects = $teacher->subjects; // pobierz przedmioty powiązane z użytkownikiem xd
        return view('teacher.subjects', compact('subjects', 'teacher'));
    }

    public function showGroupsForSubject($subjectId)
    {
        $subject = Subject::findOrFail($subjectId); // pobierz przedmiot po Id
        $groups = $subject->groups; // pobierz grupy powiązane z przedmiotem
        return view('teacher.groups', compact('groups', 'subject'));
    }

    public function showStudentsForGroup($groupId, Request $request)
    {
        $group = Group::findOrFail($groupId); // znajdź grupę po Id
        $students = $group->users()->where('role', 'uczen')->get();  // pobierz użytkowników należących do grupy i rolą "uczen"
        $subjectId = $request->query('subjectId');
        return view('teacher.students',compact('students', 'group', 'subjectId'));
    }

    public function showGradesForStudent($userId, Request $request)
    {
        $student = User::findOrFail($userId); // znajdź ucznia
        $subject= Subject::findOrFail($request->query('subjectId')); // ściągnij info o przedmiocie
        $grades = $student->grades()->where('subject_id', $subject->id)->get(); // pobierz oceny dla ucznia

        return view('teacher.grades', compact('grades', 'student', 'subject'));
    }

    public function editGrade($gradeId)
    {
        $grade = Grade::findOrFail($gradeId); // pobierz ocenę
        return view('teacher.editGrade', compact('grade'));
    }

    public function updateGrade(Request $request, $gradeId)
    {
        $grade = Grade::findOrFail($gradeId);
        $grade->update($request->only(['grade', 'comment'])); // Aktualizacja oceny
        $subjectId = $grade->subject_id; // Pobierz subjectId na podstawie oceny
        
        return redirect()->route('teacher.grades', [ // Przekierowanie z przekazaniem userId i subjectId
            'studentId' => $grade->user_id,
            'subjectId' => $subjectId
            ])->with('success', 'Ocena zaktualizowana.');
    }     

    public function newGrade(Request $request)
    {
        $studentId = $request->input('studentId');
        $subjectId = $request->input('subjectId');
        return view('teacher.newGrade', compact('studentId', 'subjectId'));
    }

    public function storeGrade(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        $grade = new Grade();
        $grade->user_id = $request->input('user_id');
        $grade->subject_id = $request->input('subject_id');
        $grade->grade = $request->input('grade');
        $grade->comment = $request->input('comment');
        $grade->save();

        return redirect()->route('teacher.grades', [
            'studentId' => $grade->user_id, 
            'subjectId' => $grade->subject_id
            ])->with('success', 'Ocena została dodana.');
    }

}
