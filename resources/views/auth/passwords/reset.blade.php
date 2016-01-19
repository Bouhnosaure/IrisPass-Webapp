@extends('layouts.auth')

@section('content')
    <div id="cl-wrapper" class="forgotpassword-container">
        <div class="middle">
            <div class="block-flat">
                <div class="header">
                    <h3 class="text-center"><img class="logo-img" src="images/theme/admin/logo.png" alt="logo"/></h3>
                </div>
                <div class="content">
                    {!! Form::open(['url' => 'password/reset', 'method' => 'POST', 'class'=> 'form-horizontal', 'style' => 'margin-bottom: 0px !important;']) !!}

                    <h5 class="title text-center"><strong>{{ trans('auth.forgot') }}</strong></h5>

                    @include('errors.auth')

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('auth.email-field')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6 col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('auth.password-field')]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('auth.password-confirmation-field')]) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::submit(trans('auth.reset'), ['class' => 'btn btn-block btn-primary btn-rad btn-lg', 'name' => 'submit-reset', 'data-dismiss' => 'modal']) !!}

                    {!! Form::close() !!}
                </div>
                <div class="text-center out-links"><a href="#">&copy; 2016 {{ trans('general.appname') }}</a></div>
            </div>
        </div>
@endsection
