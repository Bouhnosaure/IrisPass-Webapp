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

                    <select id="gorille" multiple>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>

                </div>
            </div>
        </div>
    </div>
@stop

@section('js-app-scope')
    App.dual_list('gorille');
@stop