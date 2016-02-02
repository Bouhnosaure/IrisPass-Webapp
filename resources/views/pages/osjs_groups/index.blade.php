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
                                <th style="width:20%; font-size:14px;"><b>{{ trans('osjs_groups.name') }}</b></th>
                                <th style="width:20%; font-size:14px;"><b>{{ trans('osjs_groups.users-allowed') }}</b></th>
                                <th style="width:20%; font-size:14px;"><b>{{ trans('osjs_groups.creation') }}</b></th>
                                <th style="width:20%; font-size:14px;"><b>{{ trans('osjs_groups.update') }}</b>
                            </tr>
                            </thead>
                            <tbody class="no-border-y">
                            @foreach($groups as $group)
                                <tr>
                                    <td class="isp-value">{{$group->name}}</td>
                                    <td class="isp-value">{{$group->users()->count()}}</td>
                                    <td class="isp-value">{{$group->created_at->diffForHumans()}}</td>
                                    <td class="isp-value">{{$group->updated_at->diffForHumans()}}</td>
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