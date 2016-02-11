@extends('layouts.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render('virtualdesktop') !!}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="page-head">

                <div class="row">
                    <div class="col-md-6">
                        <p style="font-size:28px;"><b>{{ trans('virtualdesktop.main-title') }}</b></p>
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
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('virtualdesktop.info-group-number') }} :</b></td>
                                                <td class="isp-value">{{$groups->count()}} <a class="btn btn-primary pull-right" href="{{action('OsjsGroupsController@create')}}">{{ trans('osjs_groups.create') }}</a></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('virtualdesktop.info-user-number') }} :</b></td>
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
                                <li class="active"><a data-toggle="tab" href="#orgausers">{{ trans('virtualdesktop.userstab-label') }}</a></li>
                                <li><a data-toggle="tab" href="#orgagroups">{{ trans('virtualdesktop.groupstab-label') }}</a></li>
                                <li><a data-toggle="tab" href="#orgagroupsaccess">{{ trans('virtualdesktop.groupsaccesstab-label') }}</a></li>
                            </ul>
                            <div class="tab-content">

                                @include('pages.virtualdesktop.partials.orgausers')

                                @include('pages.virtualdesktop.partials.orgagroups')

                                @include('pages.virtualdesktop.partials.orgagroupsaccess')

                            </div>
                            <div class="md-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection