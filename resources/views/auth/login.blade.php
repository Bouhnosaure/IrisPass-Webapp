@extends('layouts.auth')

@section('content')
    <div id="cl-wrapper" class="login-container">
        <div class="middle-login">
            <div class="block-flat">
                <div class="header">
                    <h3 class="text-center"><img class="logo-img" src="images/logo.png" alt="logo"/></h3>
                </div>
                <div class="content">

                    {!! Form::open(['url' => 'login', 'method' => 'POST', 'class'=> 'form-horizontal', 'style' => 'margin-bottom: 0px !important;']) !!}

                    <h4 class="title">{{ trans('auth.login') }}</h4>

                    @include('errors.auth')

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('remember', null, ['class' => 'form-control']) !!}
                                    {{ trans('auth.remember-field') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="foot">
                        <a href="{{ url('password/reset') }}">{{ trans('auth.forgot') }}</a>
                        <a class="btn btn-default" data-dismiss="modal" href="{{ url('register') }}">{{ trans('auth.register') }}</a>
                        {!! Form::submit(trans('auth.login'), ['class' => 'btn btn-primary', 'name' => 'submit-login', 'data-dismiss' => 'modal']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
            <div class="text-center out-links"><a href="#">&copy; 2016 {{ trans('general.appname') }}</a></div>
        </div>
    </div>
@endsection
