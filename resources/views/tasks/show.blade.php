@extends('layouts.app')

@section('title', 'Task')
@section('content')
    <h1>Task</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Creator</th>
                <th scope="col">Assigned to</th>
                <th scope="col">Created at</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <th scope="row">{{$task->id}}</th>
                    <td>{{$task->name}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->status->name}}</td>
                    <td>{{$task->creator->name}}</td>
                    <td>{{$task->assignedTo->name}}</td>
                    <td>{{$task->created_at}}</td>
                </tr>
        </tbody>
@endsection