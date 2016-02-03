<div class="cl-sidebar">
    <div class="cl-toggle"><i class="fa fa-bars"></i></div>
    <div class="cl-navblock">
        <div class="menu-space">
            <div class="content">
                <div class="sidebar-logo">
                    <div class="logo">
                        <a href="{{ action('DashboardController@index') }}"></a>
                    </div>
                </div>
                <div class="side-user">
                    <div class="info">
                        <p>4 / 10 <b>Comptes</b><span><a href="#"><i class="fa fa-plus"></i></a></span></p>
                        <div class="progress progress-user">
                            <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                 aria-valuemax="100" style="width: 40%">
                                <span class="sr-only">50% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="cl-vnavigation">
                    <li><a href="{{action('DashboardController@index')}}"><i class="fa fa-home"></i><span>{{ trans('menu.dashboard') }}</span></a></li>
                    <li><a href="#"><i class="fa fa-globe"></i><span>{{ trans('menu.organization') }}</span></a>
                        <ul class="sub-menu">
                            <li><a href="{{action('OrganizationController@index')}}">{{ trans('organization.index') }}</a></li>
                            <li><a href="{{action('OrganizationController@subscriptions')}}">{{ trans('organization.subscriptions') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>