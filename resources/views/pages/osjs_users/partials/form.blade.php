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
    {!! Form::password('password', null, ['class' => 'form-control']) !!}
</div>


<!--- password_confirmation Field --->
<div class="form-group">
    {!! Form::label('password_confirmation', trans('osjs_users.password_confirmation-field')) !!}
    {!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
</div>


<!---  Field --->
<div class="form-group">
    {!! Form::submit(trans('osjs_users.submit-create'), ['class' => 'btn btn-primary', 'name' => 'submit-osjs-users-create']) !!}
</div>