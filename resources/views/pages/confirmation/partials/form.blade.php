<!--- name Field --->
<div class="form-group">
    {!! Form::label('code', trans('confirmation.phone-code-field')) !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!---  Field --->
<div class="form-group">
    {!! Form::submit(trans('confirmation.submit-button'), ['class' => 'btn btn-primary', 'name' => 'submit-confirmation-code']) !!}
</div>