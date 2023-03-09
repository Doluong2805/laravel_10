<!doctype html>
<html lang="en" class="no-js">

<head>
    @include('client.css')
</head>

<body>
    <div class="body-wrapper">
        @include('client.header')
        @include('client.menu')

        @yield('noi_dung')

        @include('client.footer')

        @include('client.js')
        @yield('js')
    </div>
</body>

</html>
