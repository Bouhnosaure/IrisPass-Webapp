<!--- name Field --->
<div class="form-group">
    {!! Form::label('name', trans('groups.name-field')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>



<!---  Field --->
<div class="form-group">
    {!! Form::submit(trans('groups.submit-create'), ['class' => 'btn btn-primary', 'name' => 'submit-osjs-groups-create']) !!}
</div>