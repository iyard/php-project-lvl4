<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', $status->name, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}<br>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
   
    
    
    