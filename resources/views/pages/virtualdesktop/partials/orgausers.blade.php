<div id="orgausers" class="tab-pane active cont">

    @if($users->count() != 0)

        <table class="no-border no-strip information">
            <tbody class="no-border-x no-border-y">
            <tr>
                <td style="width:20%; font-size:14px;" class="category">
                    <h4>
                        <strong>{{ trans('organization.userstab-about') }} {{$organization->name}}</strong>
                    </h4>
                </td>
                <td>
                    <table class="no-border no-strip skills">
                        <thead>
                        <tr>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('organization.userstab-identifier') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('organization.userstab-username') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('organization.userstab-creation') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('organization.userstab-update') }}</b></td>
                        </tr>
                        </thead>
                        <tbody class="no-border-x no-border-y">

                        @foreach($users as $user)

                            <tr>
                                <td class="isp-value">{{$user->username}}</td>
                                <td class="isp-value">{{$user->name}}</td>
                                <td class="isp-value">{{$user->created_at->diffForHumans()}}</td>
                                <td class="isp-value">{{$user->updated_at->diffForHumans()}}</td>
                                <td><a class="btn btn-primary pull-right" href="{{action('OsjsUsersController@show',['id' => $user->id])}}">{{trans('osjs_users.show')}}</a></td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    @else

        <p class="isp-label">{{ trans('organization.userstab-no-user') }} {{$organization->name}}. <a class="btn btn-success pull-right" href="{{action('OsjsUsersController@create')}}">{{ trans('osjs_users.create')}}</a></p>

    @endif

</div>