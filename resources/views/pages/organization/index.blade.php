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
                        <p style="font-size:28px;"><b>{{ trans('organization.main-title') }}</b></p>
                    </div>
                    @if($organization)
                        <div class="col-md-2">
                            <a class="btn btn-primary btn-block pull-right" href="{{action('OrganizationController@edit')}}">{{ trans('organization.edit') }}</a>
                        </div>
                    @endif
                </div>


            </div>

            @if($organization)

                <div class="row">
                    <div class="col-sm-12">
                        <div class="block-flat profile-info">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="avatar">
                                        <i class="fa fa-building fa-5x"></i>
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
                            </ul>
                            <div class="tab-content">

                                @include('pages.organization.partials.orgainfo')

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