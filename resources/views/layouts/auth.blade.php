<!DOCTYPE html>
<html lang="en">
<head>
    @include('elements.head')
</head>

<body class="texture">

@yield('content')


        <!-- all app js-->
<script src="{{ elixir("js/light.js") }}"></script>
<script type="text/javascript">
    $(function () {
        $("#cl-wrapper").css({opacity: 1, 'margin-left': 0});
    });
</script>

</body>
</html>



