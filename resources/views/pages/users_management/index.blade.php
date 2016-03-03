@extends('layouts.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render('usersmanagement') !!}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="page-head">

                <div class="row">
                    <div class="col-md-6">
                        <p style="font-size:28px;"><b>{{ trans('usersmanagement.main-title') }}</b></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="block-flat profile-info">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="avatar">
                                        <i class="fa fa-desktop fa-5x"></i>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="personal">

                                        <table class="no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('usersmanagement.info-group-number') }} :</b></td>
                                                <td class="isp-value">{{$groups->count()}} <a class="btn btn-primary pull-right" href="{{action('GroupsController@create')}}">{{ trans('groups.create') }}</a></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('usersmanagement.info-user-number') }} :</b></td>
                                                <td class="isp-value">{{$users->count()}} <a class="btn btn-primary pull-right" href="{{action('UsersController@create')}}">{{ trans('users.create') }}</a></td>
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
                                <li class="active"><a data-toggle="tab" href="#orgausers">{{ trans('usersmanagement.userstab-label') }}</a></li>
                                <li><a data-toggle="tab" href="#orgagroups">{{ trans('usersmanagement.groupstab-label') }}</a></li>
                                <li><a data-toggle="tab" href="#orgagroupsaccess">{{ trans('usersmanagement.groupsaccesstab-label') }}</a></li>
                            </ul>
                            <div class="tab-content">

                                @include('pages.users_management.partials.orgausers')

                                @include('pages.users_management.partials.orgagroups')

                                @include('pages.users_management.partials.orgagroupsaccess')

                            </div>
                            <div class="md-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection