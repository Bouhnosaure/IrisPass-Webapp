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
                                <th style="width:20%; font-size:14px;"><b>{{ trans('osjs_users.identifier') }}</b></th>
                                <th style="width:20%; font-size:14px;"><b>{{ trans('osjs_users.username') }}</b></th>
                                <th style="width:20%; font-size:14px;"><b>{{ trans('osjs_users.creation') }}</b>
                                <th style="width:20%; font-size:14px;"><b>{{ trans('osjs_users.update') }}</b>
                            </tr>
                            </thead>
                            <tbody class="no-border-y">
                            @foreach($users as $user)
                                <tr>
                                    <td class="isp-value">{{$user->username}}</td>
                                    <td class="isp-value">{{$user->name}}</td>
                                    <td class="isp-value">{{$user->created_at->diffForHumans()}}</td>
                                    <td class="isp-value">{{$user->updated_at->diffForHumans()}}</td>
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