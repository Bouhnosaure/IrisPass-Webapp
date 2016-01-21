@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('user.profile') }}</h3>
                </div>
                <div class="content">
                    <h1>{{$user->profile->firstname}}</h1>
                </div>
            </div>
        </div>
    </div>
@stop