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
                        <p style="font-size:28px;"><b>{{ trans('website.index') }}</b></p>
                    </div>
                </div>


            </div>

            @if($website && $website->is_active)

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
                                        <h3 class="name">{{$website->identifier}}</h3>

                                        <table class="no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('website.url') }} :</b></td>
                                                <td class="isp-value"><a target="_blank" href="http://{{str_slug($organization->name, "-").'.irispass.fr'}}">{{str_slug($organization->name, "-").'.irispass.fr'}}</a></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('website.email-field') }} :</b></td>
                                                <td class="isp-value">{{$website->email}}</td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('website.username-field') }} :</b></td>
                                                <td class="isp-value">{{$website->username}}</td>
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
                                <li class="active"><a data-toggle="tab" href="#websiteactiontab">{{ trans('website.actions-label') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="websiteactiontab" class="tab-pane active cont">
                                    <table class="no-border no-strip skills">
                                        <thead>
                                        <tr>
                                            <td style="width:20%; font-size:14px;"><b>{{ trans('website.websiteactiontab-identifier') }}</b></td>
                                            <td style="width:20%; font-size:14px;"><b>{{ trans('website.websiteactiontab-destroy') }}</b></td>
                                        </tr>
                                        </thead>
                                        <tbody class="no-border-x no-border-y">
                                        <tr>
                                            <td class="isp-value">{{$website->identifier}}</td>
                                            <td>
                                                <a class="btn btn-danger pull-right"
                                                   href="{{action('WebsiteController@destroy',['id' => $website->id])}}"
                                                   data-method="DELETE"
                                                   data-token="{{csrf_token()}}"
                                                   data-confirm="{{trans('website.destroy-confirmation')}}">
                                                    {{trans('website.destroy-button')}}
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

                <p class="isp-label"> {{trans('website.info-no-cms')}}
                    <a class="btn btn-success pull-right" href="{{action('WebsiteController@create')}}">{{ trans('website.create')}}</a>
                </p>

            @endif

        </div>
    </div>

@endsection