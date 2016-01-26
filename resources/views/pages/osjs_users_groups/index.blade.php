@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <h3>{{ trans('osjs_users_groups.index') }}</h3>
                <p>{{ trans('osjs_users_groups.description') }}</p>
            </div>
        </div>
    </div>

    @foreach($groups->chunk(3) as $groups)
        <div class="row">
            @foreach($groups as $group)
                <div class="col-md-4 col-lg-4">
                    <div class="block block-color primary">
                        <div class="header">
                            <div class="actions">
                                <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a>
                            </div>
                            <h3>{{$group->name}}</h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table no-border hover">
                                    <thead class="no-border">
                                    <tr>
                                        <th><strong>{{trans('osjs_users_groups.username')}}</strong></th>
                                        <th><strong>{{trans('osjs_users_groups.status')}}</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody class="no-border-y">
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->username}}</td>
                                            <td>
                                                @if($group->users->contains('id', $user->id))
                                                    {!! Form::open(['method' => 'POST','action' => ['OsjsUserGroupsController@removeUserFromGroup', 'groupId' => $group->id,'userId' => $user->id]]) !!}
                                                    <button class="btn btn-block btn-danger" type="submit">{{trans('osjs_users_groups.disable')}}</button>
                                                    {!! Form::close() !!}
                                                @else
                                                    {!! Form::open(['method' => 'POST','action' => ['OsjsUserGroupsController@addUserToGroup','groupId' => $group->id,'userId' => $user->id]]) !!}
                                                    <button class="btn btn-block btn-primary" type="submit">{{trans('osjs_users_groups.enable')}}</button>
                                                    {!! Form::close() !!}

                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

@endsection