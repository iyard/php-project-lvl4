@extends('layouts.app')

@section('title', 'Task statuses list')
@section('content')
    @include('flash::message')
    <h1>Task statuses list</h1>
    <p>
    <a href="{{ route('statuses.create') }}" class="btn btn-success">@lang('buttons.create')</a>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
                <tr>
                    <th scope="row">{{$status->id}}</th>
                    <td>{{$status->name}}</td>
                    <td>
                        <a href="{{ route('statuses.edit', ['status' => $status]) }}" class="btn btn-info">@lang('buttons.edit')</a>
                        <a href="{{ route('statuses.destroy', ['status' => $status]) }}" class="btn btn-danger" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('buttons.delete')</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection