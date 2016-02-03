@extends('layouts.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render('show_group', $group->id) !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('osjs_groups.show') }}</h3>
                </div>
                <div class="content">
                    <h1>{{$group->name}}</h1>

                    <a class="btn btn-primary" id="groups-edit" href="{{action('OsjsGroupsController@edit', ['id' => $group->id])}}">{{ trans('osjs_groups.edit') }}</a>

                </div>
            </div>
        </div>
    </div>
@stop