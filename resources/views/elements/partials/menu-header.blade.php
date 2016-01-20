<ul class="nav navbar-nav navbar-right user-nav">
    <li class="dropdown profile_menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span>{{ Auth::user()->profile->firstname }}</span>
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{action('DashboardController@index')}}">{{ trans('menu.dashboard') }}</a>
            </li>
            <li>
                <a href="{{action('ProfileController@index')}}">{{ trans('menu.preferences') }}</a>
            </li>
            <li>
                <a href="{{action('Auth\ConfirmationController@index')}}">{{ trans('menu.confirmation') }}</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{action('Auth\AuthController@logout')}}">{{ trans('auth.logout') }}</a>
            </li>
        </ul>
    </li>
</ul>