@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ trans('confirmation.phone-validation') }}</h1>

            <hr/>

            @include('errors.list')

            {!! Form::open(['action' => 'Auth\ConfirmationController@handlePhoneCode']) !!}

            @include('pages.confirmation.partials.form')

            {!! Form::close() !!}


        </div>
    </div>
@stop