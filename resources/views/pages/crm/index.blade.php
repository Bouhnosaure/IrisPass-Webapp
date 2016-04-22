@extends('layouts.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render('organization') !!}
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="page-head">
                <div class="row">
                    <div class="col-md-10">
                        <p style="font-size:28px;"><b>{{ trans('crm.index') }}</b></p>
                    </div>
                </div>
            </div>

            @if($crm && $crm->is_active)

                <div class="row">
                    <div class="col-sm-12">
                        <div class="block-flat profile-info">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="avatar">
                                        <i class="fa fa-globe fa-5x"></i>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="personal">
                                        <h3 class="name">{{$crm->identifier}}</h3>

                                        <table class="no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('crm.url') }} :</b></td>
                                                <td class="isp-value"><a target="_blank" href="http://{{str_slug($crm->url, "-").'.crm.irispass.fr'}}">{{str_slug($crm->url, "-").'.crm.irispass.fr'}}</a></td>
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
                                <li class="active"><a data-toggle="tab" href="#crmusertab">{{ trans('crm.user-label') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="crmusertab" class="tab-pane active cont">
                                    <table class="no-border no-strip no-gorille skills">
                                        <thead>
                                        <tr>
                                            <td style="width:20%; font-size:14px;"><b>{{ trans('crm.user-name') }}</b></td>
                                            <td style="width:20%; font-size:14px;"><b>{{ trans('crm.user-mail') }}</b></td>
                                            <td style="width:20%; font-size:14px;"><b>{{ trans('crm.user-activate') }}</b></td>
                                            <td style="width:20%; font-size:14px;"><b>{{ trans('crm.user-password') }}</b></td>
                                        </tr>
                                        </thead>
                                        <tbody class="no-border-x no-border-y">
                                        <tr>
                                            <td class="isp-value">{{$user->firstname}}</td>
                                            <td class="isp-value">{{$user->email}}</td>
                                            <td>
                                                <a class="btn btn-danger pull-right"
                                                   href="{{action('CrmController@createUser',['id' => $user->id])}}"
                                                   data-method="POST"
                                                   data-token="{{csrf_token()}}"
                                                   data-confirm="{{trans('crm.create-user-confirmation')}}">
                                                    {{trans('crm.create-user-button')}}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger pull-right"
                                                   href="{{action('CrmController@createUser',['id' => $user->id])}}"
                                                   data-method="POST"
                                                   data-token="{{csrf_token()}}"
                                                   data-confirm="{{trans('crm.create-user-confirmation')}}">
                                                    {{trans('crm.create-user-button')}}
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="md-overlay"></div>
                        </div>
                    </div>
                </div>

            @else

                <p class="isp-label"> {{trans('crm.info-no-crm')}}
                    <a class="btn btn-success pull-right" href="{{action('CrmController@activateCRM')}}">{{ trans('crm.create')}}</a>
                </p>

            @endif

        </div>
    </div>


@endsection