<ul class="nav navbar-nav navbar-right user-nav">
    <li class="dropdown profile_menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img alt="Avatar" src="images/avatar6-2.jpg"/>
            <span>{{ Auth::user()->firstname }}</span>
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li><a href="#">My Account</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Messages</a></li>
            <li class="divider"></li>
            <li><a href="{{url('logout')}}">Sign Out</a></li>
        </ul>
    </li>
</ul>