<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $taskData = Task::where('status','!=','Completed')->get();
    $taskDataDone = Task::where('status','Completed')->get();
    
    return view('tasks',['taskData'=>$taskData,'taskDataDone'=>$taskDataDone  ]);
});
