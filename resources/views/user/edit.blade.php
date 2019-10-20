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
                    {{ Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) }}
                    <a href="{{ route('users.destroy', ['user' => $user]) }}" class="btn btn-danger" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('buttons.delete')</a>
                    {{ Form::close() }}  
                </div>
            </div>
        </div>
    </div>
@endsection