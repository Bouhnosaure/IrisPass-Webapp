<!-- all app js-->
<script src="{{ elixir("js/app.js") }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var App = new $.App('fr');
        @yield('js-app-scope')
    });
</script>

@yield('scripts')