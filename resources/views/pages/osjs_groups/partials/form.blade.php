<!--- name Field --->
<div class="form-group">
    {!! Form::label('name', trans('osjs_groups.name-field')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>



<!---  Field --->
<div class="form-group">
    {!! Form::submit(trans('osjs_groups.submit-create'), ['class' => 'btn btn-primary', 'name' => 'submit-osjs-groups-create']) !!}
</div>