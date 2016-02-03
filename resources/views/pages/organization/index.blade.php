@extends('layouts.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render('organization') !!}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="page-head">

                <div class="row">
                    <div class="col-md-3">
                        <p style="font-size:28px;"><b>{{ trans('organization.main-title') }}</b></p>
                    </div>
                    <div class="col-md-9">
                        <a class="btn btn-primary" href="{{action('OrganizationController@edit')}}">{{ trans('organization.edit') }}</a>
                    </div>
                </div>


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
                                        <h3 class="name">{{$organization->name}}</h3>


                                        <table class="no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('organization.info-created') }} :</b></td>
                                                <td class="isp-value">{{$organization->created_at->diffForHumans()}}</td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('organization.info-group-number') }} :</b></td>
                                                <td class="isp-value">{{$groups->count()}} <a class="btn btn-primary pull-right" href="{{action('OsjsGroupsController@create')}}">{{ trans('osjs_groups.create') }}</a></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('organization.info-user-number') }} :</b></td>
                                                <td class="isp-value">{{$users->count()}} <a class="btn btn-primary pull-right" href="{{action('OsjsUsersController@create')}}">{{ trans('osjs_users.create') }}</a></td>
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
                                <li class="active"><a data-toggle="tab" href="#orgainfo">{{ trans('organization.infotab-label') }}</a></li>
                                <li><a data-toggle="tab" href="#orgagroups">{{ trans('organization.groupstab-label') }}</a></li>
                                <li><a data-toggle="tab" href="#orgausers">{{ trans('organization.userstab-label') }}</a></li>
                                <li><a data-toggle="tab" href="#orgagroupsaccess">{{ trans('organization.groupsaccesstab-label') }}</a></li>
                            </ul>
                            <div class="tab-content">

                                @include('pages.organization.partials.orgainfo')
                                @include('pages.organization.partials.orgagroups')
                                @include('pages.organization.partials.orgausers')
                                @include('pages.organization.partials.orgagroupsaccess')

                            </div>
                            <div class="md-overlay"></div>
                        </div>
                    </div>
                </div>

            @else

                <p class="isp-label"> {{trans('organization.info-no-orga')}}
                    <a class="btn btn-success pull-right" href="{{action('OrganizationController@create')}}">{{ trans('organization.create')}}</a>
                </p>

            @endif

        </div>
    </div>

@endsection