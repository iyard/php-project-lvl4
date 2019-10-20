@extends('layouts.app')

@section('title', 'Tasks list')
@section('content')
    @include('flash::message')
    <h1>Tasks list</h1>
    <p>
    <a href="{{ route('tasks.create') }}" class="btn btn-success">@lang('buttons.create')</a>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Creator</th>
                <th scope="col">Assigned to</th>
                <th scope="col">Created at</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <th scope="row">{{$task->id}}</th>
                    <td>{{$task->name}}</td>
                    <td>{{$task->status->name}}</td>
                    <td>{{$task->creator->name}}</td>
                    <td>{{$task->assignedTo->name}}</td>
                    <td>{{$task->created_at}}</td>
                    <td>
                        <a href="{{ route('tasks.show', ['task' => $task]) }}" class="btn btn-secondary">@lang('buttons.show')</a>
                        <a href="{{ route('tasks.edit', ['task' => $task]) }}" class="btn btn-info">@lang('buttons.edit')</a>
                        <a href="{{ route('tasks.destroy', ['task' => $task]) }}" class="btn btn-danger" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('buttons.delete')</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection