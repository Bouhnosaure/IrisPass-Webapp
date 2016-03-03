<div id="orgausers" class="tab-pane active cont">

    @if($users->count() != 0)

        <table class="no-border no-strip information">
            <tbody class="no-border-x no-border-y">
            <tr>
                <td style="width:20%; font-size:14px;" class="category">
                    <h4>
                        <strong>{{ trans('usersmanagement.userstab-about') }} {{$organization->name}}</strong>
                    </h4>
                </td>
                <td>
                    <table class="no-border no-strip skills">
                        <thead>
                        <tr>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('usersmanagement.userstab-identifier') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('usersmanagement.userstab-username') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('usersmanagement.userstab-creation') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('usersmanagement.userstab-update') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('usersmanagement.userstab-show') }}</b></td>
                            <td style="width:20%; font-size:14px;"><b>{{ trans('usersmanagement.userstab-destroy') }}</b></td>
                        </tr>
                        </thead>
                        <tbody class="no-border-x no-border-y">

                        @foreach($users as $user)

                            <tr>
                                <td class="isp-value">{{$user->profile->firstname}}</td>
                                <td class="isp-value">{{$user->profile->lastname}}</td>
                                <td class="isp-value">{{$user->created_at->diffForHumans()}}</td>
                                <td class="isp-value">{{$user->updated_at->diffForHumans()}}</td>
                                <td><a class="btn btn-primary pull-right" href="{{action('UsersController@show',['id' => $user->id])}}">{{trans('usersmanagement.userstab-show-button')}}</a></td>
                                <td>
                                    <a class="btn btn-danger pull-right"
                                       href="{{action('UsersController@destroy',['id' => $user->id])}}"
                                       data-method="DELETE"
                                       data-token="{{csrf_token()}}"
                                       data-confirm="{{trans('usersmanagement.userstab-destroy-confirmation')}}">
                                        {{trans('usersmanagement.userstab-destroy-button')}}
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

        <p class="isp-label">{{ trans('usersmanagement.userstab-no-user') }} {{$organization->name}}. <a class="btn btn-success pull-right" href="{{action('UsersController@create')}}">{{ trans('users.create')}}</a></p>

    @endif

</div>