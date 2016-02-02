<!-- all app js-->
<script src="{{ elixir("js/app.js") }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var App = new $.App('fr');
        @yield('js-app-scope')
    });
</script>

<script type="text/javascript">
    //super upper !
    $(document).ready(function() {
        if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
        return $('a[data-toggle="tab"]').on('shown', function(e) {
            return location.hash = $(e.target).attr('href').substr(1);
        });
    });
</script>

@yield('scripts')