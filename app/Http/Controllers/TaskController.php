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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $taskStatuses = TaskStatus::all()->pluck('name', 'id')->toArray();
        $defaultTaskStatus = TaskStatus::where('name', 'новый')->first();
        $defaultTaskStatusId = $defaultTaskStatus->id;
        
        $users = User::all()->pluck('name', 'id')->toArray();
        $defaultUser = __('messages.defaultFieldValueName', ['fieldName' => 'user']);
        $users[null] = $defaultUser;
        
        $tags = '';
        return view('tasks.create', compact('task', 'taskStatuses', 'defaultTaskStatusId', 'users', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request)
    {
        $validated = $request->validated();
        $task = new Task();
        $task->fill($request->all());
        $task->save();
        
        $inputTags = $this->explodeTags($request->input('tags'));
        foreach ($inputTags as $tag) {
            Tag::firstOrCreate(['name' => $tag]);
        }
        $tags = Tag::whereIn('name', $inputTags)
                        ->get();
        $task->tags()->attach($tags);

        flash(__('messages.create', ['name' => 'task']))
            ->success();
        return redirect()
            ->route('tasks.index');
    }

    private function explodeTags($tags)
    {
        $explodedTags = collect(explode(',', $tags))
                        ->map(function ($tag) {
                            return trim($tag);
                        })
                        ->filter(function ($tag) {
                            return $tag != '';
                        })
                        ->all();

        return $explodedTags;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::all()->pluck('name', 'id')->toArray();
        $defaultTaskStatusId = null;
        $users = User::all()->pluck('name', 'id')->toArray();

        $tags = Task::find($task->id)->tags()->get();
        $tagsString = $tags->implode('name', ', ');

        return view('tasks.edit', compact('task', 'taskStatuses', 'defaultTaskStatusId', 'users', 'tagsString'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTask $request, Task $task)
    {
        $validated = $request->validated();
        $task->fill($request->all());
        $task->save();

        $inputTags = $this->explodeTags($request->input('tags'));
        foreach ($inputTags as $tag) {
            Tag::firstOrCreate(['name' => $tag]);
        }
        $tags = Tag::whereIn('name', $inputTags)->get();
        $task->tags()->detach();
        $task->tags()->attach($tags);

        flash(__('messages.update', ['name' => 'task']))
            ->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        flash(__('messages.delete', ['name' => 'task']))
            ->success();
        return redirect()->route('tasks.index');
    }
}
