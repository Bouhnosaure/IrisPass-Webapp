@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('osjs_users.index') }}</h3>
                </div>
                <div class="content">

                    <a class="btn btn-primary" href="{{action('OsjsUsersController@create')}}">{{ trans('osjs_users.create') }}</a>

                    <ul>
                        @foreach($users as $user)

                            <li><a href="{{action('OsjsUsersController@show',['id' => $user->id])}}">{{$user->username}}</a></li>

                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>

@endsection