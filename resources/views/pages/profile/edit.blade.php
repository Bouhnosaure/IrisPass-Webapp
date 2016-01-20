@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('user.preferences') }}</div>
                <div class="panel-body">

                    @include('errors.auth')

                    {!! Form::model($user->toArray(), ['method' => 'PATCH','action' => 'ProfileController@update', 'class'=> 'form-horizontal']) !!}

                    @include('pages.profile.partials.form-user-edit')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection