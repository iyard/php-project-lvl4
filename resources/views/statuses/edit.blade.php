@extends('layouts.app')

@section('title', 'Task status edit')
@section('content')
    <h1>Task status edit</h1>
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit status') }}</div>
                    <div class="card-body">
                        {{ Form::model($status, ['url' => route('statuses.update', ['status' => $status]), 'method' => 'PATCH']) }}
                        @include('statuses.form')
                        {{ Form::submit(@lang('buttons.save'), ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}  
                    </div>
                </div>
            </div>
        </div>
@endsection
