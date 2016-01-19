@extends('layouts.auth')

@section('content')

    <div id="cl-wrapper" class="forgotpassword-container">
        <div class="middle">
            <div class="block-flat">
                <div class="header">
                    <h3 class="text-center"><img class="logo-img" src="/images/theme/admin/logo.png" alt="logo"/></h3>
                </div>
                <div class="content">
                    {!! Form::open(['url' => 'password/email', 'method' => 'POST', 'class'=> 'form-horizontal', 'style' => 'margin-bottom: 0px !important;']) !!}

                    @include('errors.auth')

                    <h5 class="title text-center"><strong>{{ trans('auth.forgot') }}</strong></h5>

                    <!--- Email Field --->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::submit(trans('auth.reset'), ['class' => 'btn btn-block btn-primary btn-rad btn-lg', 'name' => 'submit-reset', 'data-dismiss' => 'modal']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
            <div class="text-center out-links"><a href="#">&copy; 2016 {{ trans('general.appname') }}</a></div>
        </div>
    </div>
@endsection
