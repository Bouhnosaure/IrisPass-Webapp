<div id="orgainfo" class="tab-pane active cont">
    <table class="no-border no-strip information">
        <tbody class="no-border-x no-border-y">
        <tr>
            <td style="width:20%; font-size:14px;" class="category">
                <h4>
                    <strong>{{ trans('organization.infotab-about') }} {{$organization->name}}</strong>
                </h4>
            </td>
            <td>
                <table class="no-border no-strip skills">
                    <tbody class="no-border-x no-border-y">
                    <tr>
                        <td style="width:20%; font-size:15px;"><b>{{ trans('organization.infotab-address') }}</b></td>
                        <td class="isp-value">{{$organization->address}}, {{$organization->address_comp}}</td>
                    </tr>
                    <tr>
                        <td style="width:20%; font-size:14px;"><b>{{ trans('organization.infotab-mail') }}</b></td>
                        <td class="isp-value">{{$organization->email}}</td>
                    </tr>
                    <tr>
                        <td style="width:20%; font-size:14px;"><b>{{ trans('organization.infotab-phone') }}</b></td>
                        <td class="isp-value">{{$organization->phone}}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        </tbody>
    </table>
</div>