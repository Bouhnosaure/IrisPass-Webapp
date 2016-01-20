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


<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit(trans('user.submit-edit'), ['class' => 'btn btn-primary', 'name' => 'submit-edit']) !!}
    </div>
</div>
