<div id="orgausers" class="tab-pane active cont">

    @if($users->count() != 0)

        <table class="no-border no-strip information">
            <tbody class="no-border-x no-border-y">
            <tr>
                <td style="width:20%; font-size:14px;" class="category">
                    <h4>
                        <strong>{{ trans('virtualdesktop.userstab-about') }} {{$organization->name}}</strong>
                    </h4>
                </td>
                <td>
                    <table class="no-border no-strip skills">
                        <thead>
                        <tr>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('virtualdesktop.userstab-identifier') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('virtualdesktop.userstab-username') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('virtualdesktop.userstab-creation') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('virtualdesktop.userstab-update') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('virtualdesktop.userstab-show') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('virtualdesktop.userstab-destroy') }}</b></td>
                        </tr>
                        </thead>
                        <tbody class="no-border-x no-border-y">

                        @foreach($users as $user)

                            <tr>
                                <td class="isp-value">{{$user->username}}</td>
                                <td class="isp-value">{{$user->name}}</td>
                                <td class="isp-value">{{$user->created_at->diffForHumans()}}</td>
                                <td class="isp-value">{{$user->updated_at->diffForHumans()}}</td>
                                <td><a class="btn btn-primary pull-right" href="{{action('OsjsUsersController@show',['id' => $user->id])}}">{{trans('virtualdesktop.userstab-show-button')}}</a></td>
                                <td>
                                    <a class="btn btn-danger pull-right"
                                       href="{{action('OsjsUsersController@destroy',['id' => $user->id])}}"
                                       data-method="DELETE"
                                       data-token="{{csrf_token()}}"
                                       data-confirm="{{trans('virtualdesktop.userstab-destroy-confirmation')}}">
                                        {{trans('virtualdesktop.userstab-destroy-button')}}
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

        <p class="isp-label">{{ trans('virtualdesktop.userstab-no-user') }} {{$organization->name}}. <a class="btn btn-success pull-right" href="{{action('OsjsUsersController@create')}}">{{ trans('osjs_users.create')}}</a></p>

    @endif

</div>