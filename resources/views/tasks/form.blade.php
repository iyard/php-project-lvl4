
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', $task->name, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}<br>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', $task->description, ['class' => 'form-control']) }}<br>
    @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group dropdown">
    {{ Form::label('status_id', 'Status') }}
    {{ Form::select('status_id', $taskStatuses, $defaultTaskStatusId, ['class' => 'form-control', 'required' => 'required']) }}
    @error('status_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group dropdown">
    {{ Form::label('creator_id', 'Creator') }}
    {{ Form::select('creator_id', $users, $task->creator_id, ['class' => 'form-control', 'required' => 'required']) }}
    @error('creator_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group dropdown">
    {{ Form::label('assignedTo_id', 'AssignedTo') }}
    {{ Form::select('assignedTo_id', $users, $task->assignedTo_id, ['class' => 'form-control', 'required' => 'required']) }}
    @error('assignedTo_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


