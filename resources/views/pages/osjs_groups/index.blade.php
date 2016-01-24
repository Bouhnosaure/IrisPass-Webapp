@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>{{ trans('osjs_groups.index') }}</h3>
                </div>
                <div class="content">

                    <a class="btn btn-primary" href="{{action('OsjsGroupsController@create')}}">{{ trans('osjs_groups.create') }}</a>

                    <ul>
                        @foreach($groups as $group)

                            <li><a href="{{action('OsjsGroupsController@show',['id' => $group->id])}}">{{$group->name}}</a></li>

                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>

@endsection