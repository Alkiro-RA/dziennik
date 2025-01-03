<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
});

// Home
Route::get('/', function () {
    return view('home');
})->name('home');