@extends('layouts.app')

@section('breadcrumbs')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('groups.create') }}</h3>
                </div>
                <div class="content">

                    @include('errors.list')

                    {!! Form::open(['method' => 'POST','action' => 'GroupsController@store', 'class'=> 'form-horizontal']) !!}

                    @include('pages.groups.partials.form')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection