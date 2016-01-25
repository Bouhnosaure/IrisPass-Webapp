@extends('layouts.app')

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

                    {!! Form::model($group->toArray(), ['method' => 'PATCH','action' => ['OsjsGroupsController@update', $group->id], 'class'=> 'form-horizontal', 'id' => 'form-groups', 'multiple'=> 'multiple']) !!}

                    {!! Form::select('categories[]', $users->lists('username','id')->toArray(), $group->users->lists('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple' ,'id' => 'users_groups_select']) !!}

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
@stop

@section('js-app-scope')

    App.mutliselect('users_groups_select');
    App.ajax_on_submit('form-groups');
    App.track_and_submit('form-groups','users_groups_select');

@stop