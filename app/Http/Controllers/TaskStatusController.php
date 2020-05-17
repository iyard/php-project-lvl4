<?php

namespace App\Http\Controllers;

use App\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')
             ->except('index');
    }

    public function index()
    {
        $statuses = TaskStatus::all();
        return view('statuses.index', compact('statuses'));
    }

    public function create()
    {
        $status = new TaskStatus();
        return view('statuses.create', compact('status'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:task_statuses',
        ]);
        $status = new TaskStatus();
        $status->name = $request->input('name');
        $status->slug = str_slug($status->name);
        $status->save();
        flash(__('messages.create', ['name' => 'status']))
            ->success();
        return redirect()
            ->route('statuses.index');
    }

    public function edit(TaskStatus $status)
    {
        return view('statuses.edit', compact('status'));
    }

    public function update(Request $request, TaskStatus $status)
    {
        $this->validate($request, [
            'name' => 'required|unique:task_statuses',
        ]);
        $status->name = $request->input('name');
        $status->slug = str_slug($status->name);
        $status->save();
        flash(__('messages.uodate', ['name' => 'status']))
            ->success();
        return redirect()
            ->route('statuses.index');
    }

    public function destroy(TaskStatus $status)
    {
        $status->delete();
        flash(__('messages.delete', ['name' => 'status']))
            ->success();
        return redirect()
            ->route('statuses.index');
    }
}
