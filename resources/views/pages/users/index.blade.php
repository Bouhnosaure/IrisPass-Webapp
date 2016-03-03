@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <a class="btn btn-primary pull-right" href="{{action('UsersController@create')}}">{{ trans('users.create') }}</a>
                    <h3>{{ trans('users.index') }}</h3>
                </div>
                <div class="content">

                    <div class="table-responsive">
                        <table class="table no-border hover">
                            <thead class="no-border">
                            <tr>
                                <th style="width:20%; font-size:14px;"><b>{{ trans('users.identifier') }}</b></th>
                                <th style="width:20%; font-size:14px;"><b>{{ trans('users.username') }}</b></th>
                                <th style="width:20%; font-size:14px;"><b>{{ trans('users.creation') }}</b>
                                <th style="width:20%; font-size:14px;"><b>{{ trans('users.update') }}</b>
                            </tr>
                            </thead>
                            <tbody class="no-border-y">
                            @foreach($users as $user)
                                <tr>
                                    <td class="isp-value">{{$user->username}}</td>
                                    <td class="isp-value">{{$user->name}}</td>
                                    <td class="isp-value">{{$user->created_at->diffForHumans()}}</td>
                                    <td class="isp-value">{{$user->updated_at->diffForHumans()}}</td>
                                    <td><a class="btn btn-primary pull-right" href="{{action('UsersController@show',['id' => $user->id])}}">{{trans('users.show')}}</a></td>
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