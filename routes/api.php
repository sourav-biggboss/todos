<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Create (Add) Task - Display the task creation form
Route::get('/tasks/create', [TaskController::class,'create'])->name('tasks.create');

// Create (Add) Task - Handle the task creation form submission
Route::post('/tasks', [TaskController::class,'store'])->name('tasks.store');

// Read (List) Tasks - Display a list of tasks
Route::get('/tasks', [TaskController::class,'index'])->name('tasks.index');

// Update (Edit) Task - Display the task edit form
Route::get('/tasks/{task}/edit', [TaskController::class,'edit'])->name('tasks.edit');

// Update (Edit) Task - Handle the task edit form submission
Route::put('/tasks/{task}', [TaskController::class,'update'])->name('tasks.update');

// Delete Task - Handle the task deletion
Route::delete('/tasks/{task}', [TaskController::class,'destroy'])->name('tasks.destroy');
