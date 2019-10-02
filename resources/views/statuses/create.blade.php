@extends('layouts.app')

@section('title', 'Task status create')
@section('content')
    <h1>Task status create</h1>
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create status') }}</div>
                    <div class="card-body">
                        {{ Form::model($status, ['url' => route('statuses.store')]) }}
                        @include('statuses.form')
                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}  
                    </div>
                </div>
            </div>
        </div>
@endsection
