@php
    use App\Task;
    /** @var Task $task */
    /** @var string $tagsString */
@endphp

<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', $task->name,
        ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}<br>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description', $task->description,
    ['class' => 'form-control']) }}<br>
    @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group dropdown">
    {{ Form::label('status_id', 'Status') }}
    {{ Form::select('status_id', \App\TaskStatus::getList(), $task->status_id ?? '', ['class' => 'form-control', 'required' => 'required']) }}
    @error('status_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group dropdown">
    {{ Form::label('creator_id', 'Creator') }}
    {{ Form::select('creator_id', \App\User::getList(), $task->creator_id ?? '',
    ['class' => 'form-control', 'required' => 'required']) }}
    @error('creator_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group dropdown">
    {{ Form::label('assignedTo_id', 'AssignedTo') }}
    {{ Form::select('assignedTo_id', \App\User::getList(), $task->assignedTo_id ?? '', ['class' => 'form-control', 'required' => 'required']) }}
    @error('assignedTo_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    {{ Form::label('tags', 'Tags') }}
    {{ Form::textarea('tags', $tagsString, ['class' => 'form-control', 'placeholder' => 'tag1, tag2, tag3, ...']) }}<br>
    @error('tags')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>



