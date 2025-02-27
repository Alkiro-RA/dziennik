<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradeController;

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Wymagane logowanie
Route::middleware('auth')->group(function ()
{
    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{user}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/users/{id}/role', [App\Http\Controllers\AdminController::class, 'editRole'])->name('users.role');
    Route::post('/admin/users/{id}/role', [App\Http\Controllers\AdminController::class, 'updateRole'])->name('users.updateRole');
    Route::get('create-group', [AdminController::class, 'createGroup'])->name('admin.createGroup');
    Route::post('store-group', [AdminController::class, 'storeGroup'])->name('admin.storeGroup');
    Route::get('show-groups', [AdminController::class, 'showGroups'])->name('admin.showGroups');
    Route::delete('delete-group/{id}', [AdminController::class, 'deleteGroup'])->name('admin.deleteGroup');
    Route::get('edit-group/{id}', [AdminController::class, 'editGroup'])->name('admin.editGroup');
    Route::put('update-group/{id}', [AdminController::class, 'updateGroup'])->name('admin.updateGroup');
    Route::get('group/{id}/students', [AdminController::class, 'showStudents'])->name('admin.showStudents');
    Route::get('group/{id}/assign-teacher', [AdminController::class, 'assignTeacher'])->name('admin.assignTeacher');
    Route::post('group/{id}/assign-teacher', [AdminController::class, 'storeTeacher'])->name('admin.storeTeacher');
    Route::get('/admin/groups/{groupId}/add-student', [AdminController::class, 'showAddStudentForm'])->name('admin.addStudentForm');
    Route::post('/admin/groups/{groupId}/add-student', [AdminController::class, 'addStudent'])->name('admin.addStudent');
    Route::get('/admin/subjects', [AdminController::class, 'showSubjects'])->name('admin.subjects');
    Route::get('/admin/subjects/create', [AdminController::class, 'createSubject'])->name('admin.createSubject');
    Route::post('/admin/subjects', [AdminController::class, 'storeSubject'])->name('admin.storeSubject');
    Route::get('/admin/subjects/{subject}/assign-teacher', [AdminController::class, 'assignTeacherForm'])->name('admin.assignTeacherForm');
    Route::post('/admin/subjects/{subjectId}/assign-teacher', [AdminController::class, 'assignTeacherToSubject'])->name('admin.assignTeacherToSubject');
    Route::get('/admin/subjects/{subjectId}/assign-class', [AdminController::class, 'showAssignClassToSubjectForm'])->name('admin.showAssignClassToSubjectForm');
    Route::post('/admin/subjects/{subjectId}/assign-class', [AdminController::class, 'assignClassToSubject'])->name('admin.assignClassToSubject');
    // Trasa do wyświetlania formularza przypisania nauczyciela
    Route::get('admin/subjects/{subjectId}/assign-teacher', [App\Http\Controllers\AdminController::class, 'assignTeacherToSubject'])->name('admin.assignTeacherToSubject');

    // Trasa do zapisania przypisania nauczyciela do przedmiotu
    Route::post('admin/subjects/{subjectId}/assign-teacher', [App\Http\Controllers\AdminController::class, 'assignTeacherToSubject'])->name('admin.storeTeacherToSubject');
    Route::delete('/admin/subjects/{subject}', [AdminController::class, 'deleteSubject'])->name('admin.deleteSubject');
    Route::post('/admin/subjects/{subjectId}/assign-class', [AdminController::class, 'assignClassToSubject'])->name('admin.assignClassToSubject');
    Route::delete('/admin/groups/{group}/students/{student}', [AdminController::class, 'removeStudentFromClass'])->name('admin.removeStudentFromClass');
    Route::delete('/admin/groups/{group}/remove-teacher/{teacher}', [AdminController::class, 'removeTeacherFromClass'])->name('admin.removeTeacherFromClass');


    

    // Teacher
    Route::get('/teacher', [TeacherController::class, 'showSubjects'])->name('teacher.subjects');
    Route::get('/teacher/{subjectId}/groups', [TeacherController::class, 'showGroupsForSubject'])->name('teacher.groups');
    Route::get('/teacher/{groupId}/students', [TeacherController::class, 'showStudentsForGroup'])->name('teacher.students');
    // Teacher // Grades
    Route::get('/teacher/{studentId}/grades', [TeacherController::class, 'showGradesForStudent'])->name('teacher.grades');
    Route::get('/teacher/grades/{gradeId}/edit', [TeacherController::class, 'editGrade'])->name('teacher.editGrade');
    Route::post('/teacher/grades/new', [TeacherController::class, 'newGrade'])->name('teacher.newGrade');
    Route::put('/teacher/grades/{gradeId}', [TeacherController::class, 'updateGrade'])->name('teacher.updateGrade');
    Route::post('/teacher/grades', [TeacherController::class, 'storeGrade'])->name('teacher.storeGrade');

    //Oceny ucznia 
    Route::get('/student/grades', [GradeController::class, 'showGrades'])->name('student.showGrades')->middleware('auth'); // Wyświetlanie ocen
});

// Home
Route::get('/', function () {
    return view('home');
})->name('home');