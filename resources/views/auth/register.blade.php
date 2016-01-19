@extends('layouts.auth')

@section('content')
    <div id="cl-wrapper" class="sign-up-container">
        <div class="middle-sign-up">
            <div class="block-flat">
                <div class="header">
                    <h3 class="text-center"><img class="logo-img" src="/images/theme/admin/logo.png" alt="logo"/></h3>
                </div>

                <div class="content">
                    {!! Form::open(['url' => 'register', 'method' => 'POST', 'class'=> 'form-horizontal', 'style' => 'margin-bottom: 0px !important;']) !!}


                    <h5 class="title text-center"><strong>{{ trans('auth.register') }}</strong></h5>

                    @include('errors.auth')

                    <div class="form-group">
                        <div class="col-sm-6 col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => trans('auth.firstname-field')]) !!}
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => trans('auth.lastname-field')]) !!}
                            </div>
                        </div>
                    </div>

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

                    {!! Form::submit(trans('auth.register'), ['class' => 'btn btn-block btn-success btn-rad btn-lg', 'name' => 'submit-register']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
            <div class="text-center out-links"><a href="#">&copy; 2016 {{ trans('general.appname') }}</a></div>
        </div>
    </div>
@endsection
