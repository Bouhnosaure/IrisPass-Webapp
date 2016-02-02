@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="page-head">
                <h3>{{ trans('organization.main-title') }}</h3>
            </div>

            @if($organization)

                <div class="row">
                    <div class="col-sm-12">
                        <div class="block-flat profile-info">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="avatar">
                                        <img src="images/theme/admin/orga.png"
                                             alt="user-avatar" class="profile-avatar"/>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="personal">
                                        <h1 class="name">{{$organization->name}}</h1>

                                        <table class="no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:25%; font-size:16px;">
                                                    <b>{{ trans('organization.info-created') }} :</b></td>
                                                <td class="isp-value">{{$organization->created_at->diffForHumans()}}</td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%; font-size:16px;">
                                                    <b>{{ trans('organization.info-group-number') }} :</b></td>
                                                <td class="isp-value">{{$groups->count()}} <a
                                                            class="btn btn-primary pull-right"
                                                            href="{{action('OsjsGroupsController@create')}}">{{ trans('osjs_groups.create') }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%; font-size:16px;">
                                                    <b>{{ trans('organization.info-user-number') }} :</b></td>
                                                <td class="isp-value">{{$users->count()}} <a
                                                            class="btn btn-primary pull-right"
                                                            href="{{action('OsjsUsersController@create')}}">{{ trans('osjs_users.create') }}</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab"
                                                      href="#orgainfo">{{ trans('organization.infotab-label') }} :</a>
                                </li>
                                <li><a data-toggle="tab" href="#orgagroups">{{ trans('organization.groupstab-label') }}
                                        :</a></li>
                                <li><a data-toggle="tab" href="#orgausers">{{ trans('organization.userstab-label') }}
                                        :</a></li>
                                <li><a data-toggle="tab"
                                       href="#orgagroupsaccess">{{ trans('organization.groupsaccesstab-label') }} :</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="orgainfo" class="tab-pane active cont">
                                    <table class="no-border no-strip information">
                                        <tbody class="no-border-x no-border-y">
                                        <tr>
                                            <td style="width:20%; font-size:14px;" class="category">
                                                <h4>
                                                    <strong>{{ trans('organization.infotab-about') }} {{$organization->name}}</strong>
                                                </h4>
                                            </td>
                                            <td>
                                                <table class="no-border no-strip skills">
                                                    <tbody class="no-border-x no-border-y">
                                                    <tr>
                                                        <td style="width:20%; font-size:15px;">
                                                            <b>{{ trans('organization.infotab-address') }}</b></td>
                                                        <td class="isp-value">{{$organization->address}}
                                                            , {{$organization->address_comp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%; font-size:14px;">
                                                            <b>{{ trans('organization.infotab-mail') }}</b></td>
                                                        <td class="isp-value">{{$organization->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:20%; font-size:14px;">
                                                            <b>{{ trans('organization.infotab-phone') }}</b></td>
                                                        <td class="isp-value">{{$organization->phone}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div id="orgagroups" class="tab-pane cont">

                                    @if($groups->count() != 0)

                                        <table class="no-border no-strip information">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:20%; font-size:14px;" class="category">
                                                    <h4>
                                                        <strong>{{ trans('organization.groupstab-about') }} {{$organization->name}}</strong>
                                                    </h4>
                                                </td>
                                                <td>
                                                    <table class="no-border no-strip skills">
                                                        <thead>
                                                        <tr>
                                                            <td style="width:20%; font-size:14px;">
                                                                <b>{{ trans('organization.groupstab-name') }}</b></td>
                                                            <td style="width:20%; font-size:14px;">
                                                                <b>{{ trans('organization.groupstab-users-allowed') }}</b>
                                                            </td>
                                                            <td style="width:20%; font-size:14px;">
                                                                <b>{{ trans('organization.groupstab-creation') }}</b>
                                                            </td>
                                                            <td style="width:20%; font-size:14px;">
                                                                <b>{{ trans('organization.groupstab-update') }}</b>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="no-border-x no-border-y">

                                                        @foreach($groups as $group)

                                                            <tr>
                                                                <td class="isp-value">{{$group->name}}</td>
                                                                <td class="isp-value">{{$group->users()->count()}}</td>
                                                                <td class="isp-value">{{$group->created_at->diffForHumans()}}</td>
                                                                <td class="isp-value">{{$group->updated_at->diffForHumans()}}</td>
                                                                <td><a class="btn btn-primary pull-right"
                                                                       href="{{action('OsjsGroupsController@show',['id' => $group->id])}}">{{trans('osjs_groups.show')}}</a>
                                                                </td>
                                                            </tr>

                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    @else

                                        <p class="isp-label">{{ trans('organization.groupstab-no-group') }} {{$organization->name}}
                                            . <a
                                                    class="btn btn-success pull-right"
                                                    href="{{action('OsjsGroupsController@create')}}">{{ trans('osjs_groups.create')}}</a>
                                        </p>

                                    @endif

                                </div>
                                <div id="orgausers" class="tab-pane cont">

                                    @if($users->count() != 0)

                                        <table class="no-border no-strip information">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:20%; font-size:14px;" class="category">
                                                    <h4>
                                                        <strong>{{ trans('organization.userstab-about') }} {{$organization->name}}</strong>
                                                    </h4>
                                                </td>
                                                <td>
                                                    <table class="no-border no-strip skills">
                                                        <thead>
                                                        <tr>
                                                            <td style="width:20%; font-size:14px;">
                                                                <b>{{ trans('organization.userstab-identifier') }}</b>
                                                            </td>
                                                            <td style="width:20%; font-size:14px;">
                                                                <b>{{ trans('organization.userstab-username') }}</b>
                                                            </td>
                                                            <td style="width:20%; font-size:14px;">
                                                                <b>{{ trans('organization.userstab-creation') }}</b>
                                                            <td style="width:20%; font-size:14px;">
                                                                <b>{{ trans('organization.userstab-update') }}</b>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="no-border-x no-border-y">

                                                        @foreach($users as $user)

                                                            <tr>
                                                                <td class="isp-value">{{$user->username}}</td>
                                                                <td class="isp-value">{{$user->name}}</td>
                                                                <td class="isp-value">{{$user->created_at->diffForHumans()}}</td>
                                                                <td class="isp-value">{{$user->updated_at->diffForHumans()}}</td>
                                                                <td><a class="btn btn-primary pull-right"
                                                                       href="{{action('OsjsUsersController@show',['id' => $user->id])}}">{{trans('osjs_users.show')}}</a>
                                                                </td>
                                                            </tr>

                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    @else

                                        <p class="isp-label">{{ trans('organization.userstab-no-user') }} {{$organization->name}}. <a class="btn btn-success pull-right" href="{{action('OsjsUsersController@create')}}">{{ trans('osjs_users.create')}}</a>
                                        </p>

                                    @endif

                                </div>

                                <div id="orgagroupsaccess" class="tab-pane cont">

                                    @if($users->count() > 0 || $groups->count() > 0)

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
                                                                                        <button class="btn btn-block btn-danger" name="submit-disable" type="submit">{{trans('osjs_users_groups.disable')}}</button>
                                                                                        {!! Form::close() !!}
                                                                                    @else
                                                                                        {!! Form::open(['method' => 'POST','action' => ['OsjsUserGroupsController@addUserToGroup','groupId' => $group->id,'userId' => $user->id]]) !!}
                                                                                        <button class="btn btn-block btn-primary" name="submit-enable" type="submit">{{trans('osjs_users_groups.enable')}}</button>
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

                                    @elseif($users->count() == 0 && $groups->count() == 0)
                                        {{ trans('organization.groupaccesstab-no-user-no-group') }} <a
                                                class="btn btn-primary pull-right"
                                                href="{{action('OsjsGroupsController@create')}}">{{ trans('osjs_groups.create') }}</a> <a
                                                class="btn btn-primary pull-right"
                                                href="{{action('OsjsUsersController@create')}}">{{ trans('osjs_users.create') }}</a>

                                    @elseif($users->count() == 0)
                                        {{ trans('organization.groupaccesstab-no-user') }} <a
                                                class="btn btn-primary pull-right"
                                                href="{{action('OsjsUsersController@create')}}">{{ trans('osjs_users.create') }}</a>
                                    @elseif($groups->count() == 0)
                                        {{ trans('organization.groupaccesstab-no-group') }} <a
                                                class="btn btn-primary pull-right"
                                                href="{{action('OsjsGroupsController@create')}}">{{ trans('osjs_groups.create') }}</a>
                                    @endif
                                </div>

                            </div>
                            <div class="md-overlay"></div>
                        </div>
                    </div>
                </div>

            @else

                <p class="isp-label"> {{trans('organization.info-no-orga')}} <a class="btn btn-success pull-right"
                                                                                href="{{action('OrganizationController@create')}}">{{ trans('organization.create')}}</a>
                </p>

            @endif

        </div>
    </div>

@endsection