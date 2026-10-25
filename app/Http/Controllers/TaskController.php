<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = DB::table('tasks')->get();
        return view('matrix', compact('tasks'));
    }   

    // Update an existing task
    public function update(Request $request, $id)
    {
        DB::table('tasks')->where('id', $id)->update([
            'title' => $request->title,
            'priority' => $request->priority,
            'difficulty' => $request->difficulty,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'reminder' => $request->reminder,
            'location' => $request->location,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    // Toggle task completion (Mark as done / undone)
    public function toggleComplete($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        
        DB::table('tasks')->where('id', $id)->update([
            'is_completed' => !$task->is_completed, // Flips true to false, or false to true
            'updated_at' => now(),
        ]);

        return redirect()->back();
    }
}
