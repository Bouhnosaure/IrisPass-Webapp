<div id="orgagroups" class="tab-pane cont">

    @if($groups->count() != 0)

        <table class="no-border no-strip information">
            <tbody class="no-border-x no-border-y">
            <tr>
                <td style="width:20%; font-size:14px;" class="category">
                    <h4>
                        <strong>{{ trans('organization.groupstab-about') }} {{$organization->name}}</strong>
                    </h4>
                </td>
                <td>
                    <table class="no-border no-strip skills">
                        <thead>
                        <tr>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('organization.groupstab-name') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('organization.groupstab-users-allowed') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('organization.groupstab-creation') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('organization.groupstab-update') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('organization.groupstab-destroy') }}</b></td>
                        </tr>
                        </thead>
                        <tbody class="no-border-x no-border-y">

                        @foreach($groups as $group)

                            <tr>
                                <td class="isp-value">{{$group->name}}</td>
                                <td class="isp-value">{{$group->users()->count()}}</td>
                                <td class="isp-value">{{$group->created_at->diffForHumans()}}</td>
                                <td class="isp-value">{{$group->updated_at->diffForHumans()}}</td>
                                <td><a class="btn btn-primary pull-right" href="{{action('OsjsGroupsController@show',['id' => $group->id])}}">{{trans('osjs_groups.show')}}</a></td>
                                <td>
                                    <a class="btn btn-danger pull-right"
                                       href="{{action('OsjsGroupsController@destroy',['id' => $group->id])}}"
                                       data-method="DELETE"
                                       data-token="{{csrf_token()}}"
                                       data-confirm="{{trans('osjs_groups.destroy_confirmation')}}">
                                        {{trans('osjs_groups.destroy')}}
                                    </a>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>

    @else

        <p class="isp-label">{{ trans('organization.groupstab-no-group') }} {{$organization->name}}. <a class="btn btn-success pull-right" href="{{action('OsjsGroupsController@create')}}">{{ trans('osjs_groups.create')}}</a></p>

    @endif

</div>