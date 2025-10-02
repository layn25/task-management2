<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ProjectController extends Controller
{
    public function index()
    {
        $data = Project::all();
        return view('pages.project.index', compact('data'));
    }
    public function detail($id)
    {
        $users = User::all();
        $data = Project::where('project_id', $id)->firstOrFail();
        $tasks = task::all();
        return view('pages.project.detail', compact('data', 'users', 'tasks'));
    }
    public function create()
    {
        $users = User::all();
        return view('pages.project.create', compact('users'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'        => 'required|string|max:150',
                'description' => 'nullable|string',
                'start_date'  => 'required|date',
                'end_date'    => 'required|date|after_or_equal:start_date',
                'owner_id'    => 'required|exists:users,id',
            ]);

            $data = new Project();
            $data->name        = $request->name;
            $data->description = $request->description;
            $data->start_date  = Carbon::parse($request->start_date)->format('Y-m-d');
            $data->end_date    = Carbon::parse($request->end_date)->format('Y-m-d');
            $data->owner_id    = $request->owner_id;
            $data->staff_created = Auth::id();
            $data->staff_updated = Auth::id();
            $data->save();

            return redirect()->back()->with('success', 'Project berhasil ditambahkan!');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }



    public function storeTask(Request $request)
    {
        try {
            $request->validate([
                'project_id'  => 'required|exists:projects,project_id',
                'title'       => 'required|string|max:200',
                'description' => 'nullable|string',
                'status'      => 'required|in:todo,in_progress,review,done',
                'priority'    => 'required|in:low,medium,high,urgent',
                'start_date'  => 'required|date',
                'end_date'    => 'required|date|after_or_equal:start_date',
                'assignee_id' => 'required|exists:users,id',
                'reporter_id' => 'required|exists:users,id',
                'percentage'  => 'required|integer|min:0|max:100',
            ]);

            $task = new Task();
            $task->project_id    = $request->project_id;
            $task->title         = $request->title;
            $task->description   = $request->description;
            $task->status        = $request->status;
            $task->priority      = $request->priority;
            $task->start_date    = Carbon::parse($request->start_date)->format('Y-m-d');
            $task->end_date      = Carbon::parse($request->end_date)->format('Y-m-d');
            $task->assignee_id   = $request->assignee_id;
            $task->reporter_id   = $request->reporter_id;
            $task->percentage    = $request->percentage;
            $task->staff_created = Auth::id();
            $task->staff_updated = Auth::id();
            $task->save();

            return redirect()->back()->with('success', 'Task berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function editTask(Request $request, $id)
    {
        try {
            $request->validate([
                'title'       => 'required|string|max:200',
                'description' => 'nullable|string',
                'status'      => 'required|in:todo,in_progress,review,done',
                'priority'    => 'required|in:low,medium,high,urgent',
                'start_date'  => 'required|date',
                'end_date'    => 'required|date|after_or_equal:start_date',
                'assignee_id' => 'required|exists:users,id',
                'reporter_id' => 'required|exists:users,id',
                'percentage'  => 'required|integer|min:0|max:100',
            ]);

            Task::where('task_id', $id)->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'status'        => $request->status,
                'priority'      => $request->priority,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'assignee_id'   => $request->assignee_id,
                'reporter_id'   => $request->reporter_id,
                'percentage'    => $request->percentage,
                'staff_updated' => Auth::id(),
            ]);

            return redirect()->back()->with('success', 'Task berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deleteTask($id)
    {
        try {
            $task = Task::where('task_id', $id)->firstOrFail();

            // cek apakah user login adalah owner project
            if (Auth::id() !== $task->project->owner_id) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus task ini.');
            }

            $task->delete();

            return redirect()->back()->with('success', 'Task berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }



}
