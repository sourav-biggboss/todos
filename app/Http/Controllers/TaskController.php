<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        // return $request->all();
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        // Create a new task
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = 'Pending'; // Set the initial status

        // Save the task to the database
        $task->save();

        // Optionally, return a response to indicate success
        return response()->json(['message' => 'Task created successfully'], 201);
    }


    public function index(Request $request)
    {
        // Fetch all tasks from the database
        $tasks = Task::all();

        // Optionally, return tasks as JSON for AJAX requests
        return response()->json($tasks);
    }

    public function update(Request $request, $id)
    {
        // Find the task by its ID
        $task = Task::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'in:Pending,Completed', // Define allowed statuses
        ]);

        // Update the task properties
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');

        // Save the updated task to the database
        $task->save();

        // Optionally, return a response to indicate success
        return response()->json(['message' => 'Task updated successfully'], 200);
    }

    public function destroy($id)
    {
        // Find the task by its ID
        $task = Task::findOrFail($id);

        // Delete the task
        $task->delete();

        // Optionally, return a response to indicate success
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
