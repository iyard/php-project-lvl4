@extends('layouts.app')

@section('title', 'Users list')
@section('content')
    <h1>Users List</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">E-mail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                <td><a href="{{ route('users.show', ['user' => $user]) }}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection