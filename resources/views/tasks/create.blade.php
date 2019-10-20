@extends('layouts.app')

@section('title', 'Task create')
@section('content')
    <h1>Task create</h1>
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create status') }}</div>
                    <div class="card-body">
                        {{ Form::model($task, ['url' => route('tasks.store')]) }}
                        @include('tasks.form')
                        {{ Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}  
                    </div>
                </div>
            </div>
        </div>
@endsection
