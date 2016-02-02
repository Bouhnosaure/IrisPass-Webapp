@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-6 col-sm-6">
            <div class="fd-tile detail clean tile-prusia">
                <div class="content"><h1 class="text-left">170</h1>
                    <p>{{trans('dashboard.count_users')}}</p></div>
                <div class="icon"><i class="fa fa-users"></i></div>
                <a class="details" href="{{action('OrganizationController@index').'#orgausers'}}">{{trans('dashboard.show_detail')}}<span><i class="fa fa-arrow-circle-right pull-right"></i></span></a>
            </div>
        </div>


        <div class="col-md-6 col-sm-6">
            <div class="fd-tile detail clean tile-prusia">
                <div class="content"><h1 class="text-left">170</h1>
                    <p>{{trans('dashboard.count_groups')}}</p></div>
                <div class="icon"><i class="fa fa-group"></i></div>
                <a class="details" href="{{action('OrganizationController@index').'#orgagroups'}}">{{trans('dashboard.show_detail')}}<span><i class="fa fa-arrow-circle-right pull-right"></i></span></a>
            </div>
        </div>

    </div>
@endsection
