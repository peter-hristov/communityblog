<html>

    <head>
        <meta charset="utf-8">
        <title>So Epic!</title>
        <link href="/assets/stylesheets/application.css" rel="stylesheet">
        <link href="/assets/stylesheets/vendor/bootstrap.css" rel="stylesheet">
        <script src="/assets/javascripts/application.js"></script>

    </head>
    <body>

        <div class="page-wrap">
            @include('element.header')

            @include('element.navbar')

            <div class="content container">
                @yield('content')
            </div>
        </div>

        @include('element.footer')
    </body>
</html>