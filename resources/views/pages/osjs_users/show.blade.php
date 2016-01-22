@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('osjs_users.show') }}</h3>
                </div>
                <div class="content">
                    <h1>{{$user->username}}</h1>

                    <a class="btn btn-primary" href="{{action('OsjsUsersController@edit', ['id' => $user->id])}}">Editer</a>
                </div>
            </div>
        </div>
    </div>
@stop