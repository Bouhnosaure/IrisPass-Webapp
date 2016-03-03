@extends('layouts.app')

@section('breadcrumbs')
    {!! Breadcrumbs::render('create_user') !!}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('users.create') }}</h3>
                </div>
                <div class="content">

                    @include('errors.list')

                    {!! Form::open(['method' => 'POST','action' => 'UsersController@store', 'class'=> 'form-horizontal']) !!}

                    @include('pages.users.partials.form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection