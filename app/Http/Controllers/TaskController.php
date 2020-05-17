<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTask;
use App\Task;
use App\TaskStatus;
use App\User;
use App\Tag;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
             ->except('index');
    }

    public function index(Request $request)
    {
        $creatorName = $request->input('creatorName') ?? '';
        $assignedToName = $request->input('assignedToName') ?? '';
        $taskStatusId = $request->input('status_id') ?? 0;
        $tag = $request->input('tag') ?? '';

        $tasks = Task::OfCreator($creatorName)
            ->OfAssignedTo($assignedToName)
            ->OfTaskStatus($taskStatusId)
            ->OfTags($tag)
            ->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $task = new Task();
        $tagsString = getTagsString($task->id);
        return view('tasks.create', compact('task', 'tagsString'));
    }

    public function store(StoreTask $request)
    {
        $validated = $request->validated();
        $task = new Task();
        $task->fill($request->all());
        $task->save();
        saveTags($task, $request->input('tags'));

        flash(__('messages.create', ['name' => 'task']))
            ->success();
        return redirect()
            ->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $tagsString = getTagsString($task->id);
        return view('tasks.edit', compact('task', 'tagsString'));
    }

    public function update(StoreTask $request, Task $task)
    {
        $validated = $request->validated();
        $task->fill($request->all());
        $task->save();
        saveTags($task, $request->input('tags'));

        flash(__('messages.update', ['name' => 'task']))
            ->success();
        return redirect()
            ->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->tags()->detach();
        $task->delete();
        flash(__('messages.delete', ['name' => 'task']))
            ->success();
        return redirect()->route('tasks.index');
    }
}
