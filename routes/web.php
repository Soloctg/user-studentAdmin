<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






Route::middleware(['auth', 'verified', 'role:2'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function() {
        Route::get('/timetable', [\App\Http\Controllers\Teacher\TimetableController::class, 'index'])
            ->name('timetable');

        // ... other routes for teachers in the future
    });


Route::middleware(['auth', 'verified', 'role:3'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function() {
        Route::get('/students', [Admin\StudentsController::class, 'index'])
            ->name('students');
    });



//Route::get('/student/some_page', [\App\Http\Controllers\Student\SomeController::class, 'index'])
//    ->middleware(['auth', 'verified'])
//    ->name('student.some_page');

//Route::get('/student/another_page', [\App\Http\Controllers\Student\AnotherController::class, 'index'])
//    ->middleware(['auth', 'verified'])
//    ->name('student.another_page');

require __DIR__.'/auth.php';
require __DIR__.'/student.php';
