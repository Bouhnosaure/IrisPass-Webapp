@extends('layouts.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render('show_user', $user->id) !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('users.show') }}</h3>
                </div>
                <div class="content">

                    <h1>{{$user->username}}</h1>

                    <a class="btn btn-primary" id="users-edit" href="{{action('UsersController@edit', ['id' => $user->id])}}">{{trans('users.edit')}}</a>
                </div>
            </div>
        </div>
    </div>
@stop