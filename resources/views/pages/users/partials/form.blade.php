<!--- Email Field --->
<div class="form-group">
    <label class="col-md-4 control-label">
        {!! Form::label('email', trans('user.email-field')) !!}
    </label>

    <div class="col-md-6">
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!--- firstname  Field --->
<div class="form-group">
    <label class="col-md-4 control-label">
        {!! Form::label('profile[firstname]', trans('user.firstname-field')) !!}
    </label>

    <div class="col-md-6">
        {!! Form::text('profile[firstname]', null, ['id' => 'firstname' ,'class' => 'form-control']) !!}
    </div>
</div>

<!--- lastname  Field --->
<div class="form-group">
    <label class="col-md-4 control-label">
        {!! Form::label('profile[lastname]', trans('user.lastname-field')) !!}
    </label>

    <div class="col-md-6">
        {!! Form::text('profile[lastname]', null, ['id' => 'lastname' ,'class' => 'form-control']) !!}
    </div>
</div>

<!--- phone Field --->
<div class="form-group">
    <label class="col-md-4 control-label">
        {!! Form::label('profile[phone]', trans('user.phone-field')) !!}
    </label>

    <div class="col-md-6">
        {!! Form::text('profile[phone]', null, ['id' => 'phone' ,'class' => 'form-control']) !!}
    </div>
</div>

<!--- password Field --->
<div class="form-group">
    {!! Form::label('password', trans('users.password-field')) !!}
    <input class="form-control" name="password" type="password" id="password">
</div>


<!--- password_confirmation Field --->
<div class="form-group">
    {!! Form::label('password_confirmation', trans('users.password_confirmation-field')) !!}
    <input class="form-control" name="password_confirmation" type="password" id="password_confirmation">
</div>


<!---  Field --->
<div class="form-group">
    {!! Form::submit(trans('users.submit-create'), ['class' => 'btn btn-primary', 'name' => 'submit-osjs-users-create']) !!}
</div>