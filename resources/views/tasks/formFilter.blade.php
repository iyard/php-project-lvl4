<div class="form-group">
    {{ Form::label('creatorName', 'Creator name') }}
    {{ Form::text('creatorName', request('creatorName'),
        ['class' => 'form-control', 'placeholder' => 'Creator name']) }}<br>
</div>

<div class="form-group">
    {{ Form::label('assignedToName', 'Assigned to name') }}
    {{ Form::text('assignedToName', request('assignedToName'),
        ['class' => 'form-control', 'placeholder' => 'Assigned to name']) }}<br>
</div>

<div class="form-group dropdown">
    {{ Form::label('status_id', 'Status') }}
    {{ Form::select('status_id', \App\TaskStatus::getList(), request('taskStatusId'),
        ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('tag', 'Tag') }}
    {{ Form::text('tag', request('tag'), ['class' => 'form-control', 'placeholder' => 'tag1']) }}<br>
</div>
