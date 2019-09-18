
<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}<br>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'example@gmail.com', 'required' => 'required']) }}<br>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password', ['class' => 'form-control', 'required' => 'required']) }}<br>
    @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {{ Form::label('password_confirmation', 'Confirm password') }}
    {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off']) }}<br>
    @error('password_confirmation')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


