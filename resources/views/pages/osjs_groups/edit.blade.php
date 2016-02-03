@extends('layouts.app')
@section('breadcrumbs')
    {!! Breadcrumbs::render('edit_group', $group->id) !!}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('osjs_groups.edit') }}</h3>
                </div>
                <div class="content">

                    @include('errors.list')

                    {!! Form::model($group->toArray(), ['method' => 'PATCH','action' => ['OsjsGroupsController@update', $group->id], 'class'=> 'form-horizontal']) !!}

                    @include('pages.osjs_groups.partials.form')

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>

@endsection

