<!DOCTYPE html>
<html lang="en">
<head>
    @include('elements.head')
</head>
<body class="animated">

<div id="cl-wrapper">

    @include('elements.sidebar')
    @include('elements.header')

    <div class="cl-mcont">
        @include('flash::message')
        @yield('content')
    </div>

    @include('elements.footer')
</div>

</div>

@include('elements.scripts')
</body>
</html>



