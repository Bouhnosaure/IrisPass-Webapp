<!--- username Field --->
<div class="form-group">
    {!! Form::label('username', trans('osjs_users.username-field')) !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!--- name Field --->
<div class="form-group">
    {!! Form::label('name', trans('osjs_users.name-field')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!--- password Field --->
<div class="form-group">
    {!! Form::label('password', trans('osjs_users.password-field')) !!}
    <input class="form-control" name="password" type="password" id="password">
</div>


<!--- password_confirmation Field --->
<div class="form-group">
    {!! Form::label('password_confirmation', trans('osjs_users.password_confirmation-field')) !!}
    <input class="form-control" name="password_confirmation" type="password" id="password_confirmation">
</div>


<!---  Field --->
<div class="form-group">
    {!! Form::submit(trans('osjs_users.submit-create'), ['class' => 'btn btn-primary', 'name' => 'submit-osjs-users-create']) !!}
</div>