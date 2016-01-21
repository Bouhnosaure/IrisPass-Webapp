@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('user.preferences') }}</h3>
                </div>
                <div class="content">

                    @include('errors.list')

                    {!! Form::model($user->toArray(), ['method' => 'PATCH','action' => 'ProfileController@update', 'class'=> 'form-horizontal']) !!}

                    @include('pages.profile.partials.form-user-edit')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection