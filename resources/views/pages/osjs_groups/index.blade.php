@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <a class="btn btn-primary pull-right" href="{{action('OsjsGroupsController@create')}}">{{ trans('osjs_groups.create') }}</a>
                    <h3>{{ trans('osjs_groups.index') }}</h3>
                </div>
                <div class="content">


                    <div class="table-responsive">
                        <table class="table no-border hover">
                            <thead class="no-border">
                            <tr>
                                <th><strong>{{trans('osjs_groups.name')}}</strong></th>
                                <th><strong>{{trans('osjs_groups.users_count')}}</strong></th>
                                <th><strong>{{trans('osjs_users.action')}}</strong></th>
                            </tr>
                            </thead>
                            <tbody class="no-border-y">
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{$group->name}}</td>
                                    <td>{{$group->users()->count()}}</td>
                                    <td><a class="btn btn-primary pull-right" href="{{action('OsjsGroupsController@show',['id' => $group->id])}}">{{trans('osjs_groups.show')}}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection