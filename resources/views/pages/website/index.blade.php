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

            @if($organization->is_active_cms)

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
                                        <h3 class="name">{{$organization->name}}</h3>

                                        <table class="no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">
                                            <tr>
                                                <td style="width:25%; font-size:16px;"><b>{{ trans('website.url') }} :</b></td>
                                                <td class="isp-value"><a target="_blank" href="http://{{str_slug($organization->name, "-").'.irispass.fr'}}">{{str_slug($organization->name, "-").'.irispass.fr'}}</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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