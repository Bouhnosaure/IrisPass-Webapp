<div id="head-nav" class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-collapse">

            @include('elements.partials.menu-header')
            @yield('breadcrumbs')
            @include('elements.partials.notifications-header')

        </div>
    </div>
</div>

@yield('header')