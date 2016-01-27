@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <a class="btn btn-primary pull-right" href="{{action('OsjsUsersController@create')}}">{{ trans('osjs_users.create') }}</a>
                    <h3>{{ trans('osjs_users.index') }}</h3>
                </div>
                <div class="content">

                    <div class="table-responsive">
                        <table class="table no-border hover">
                            <thead class="no-border">
                            <tr>
                                <th><strong>{{trans('osjs_users.username')}}</strong></th>
                                <th><strong>{{trans('osjs_users.groups_count')}}</strong></th>
                                <th><strong>{{trans('osjs_users.action')}}</strong></th>
                            </tr>
                            </thead>
                            <tbody class="no-border-y">
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->groups()->count()}}</td>
                                    <td><a class="btn btn-primary pull-right" href="{{action('OsjsUsersController@show',['id' => $user->id])}}">{{trans('osjs_users.show')}}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection