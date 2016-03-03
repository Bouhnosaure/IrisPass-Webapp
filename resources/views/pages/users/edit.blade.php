@extends('layouts.app')
@section('breadcrumbs')
    {!! Breadcrumbs::render('edit_user', $user->id) !!}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('users.edit') }}</h3>
                </div>
                <div class="content">

                    @include('errors.list')

                    {!! Form::model($user->toArray(), ['method' => 'PATCH','action' => ['UsersController@update', $user->id], 'class'=> 'form-horizontal']) !!}

                    @include('pages.users.partials.form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection