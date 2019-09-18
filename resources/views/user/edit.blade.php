@extends('layouts.app')

@section('title', 'Edit user')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit user') }}</div>
                <div class="card-body">
                    {{ Form::model($user, ['url' => route('users.update', ['user' => $user]), 'method' => 'PATCH']) }}
                    @include('user.form')
                    {{ Form::submit('Обновить', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}  
                </div>
            </div>
        </div>
    </div>
@endsection