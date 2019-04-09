<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @if (Auth::guard('admin')->check())
        @include('inc.navbar')
        <div id="app" style="position:relative; top:3.5em">
            <div class="col-md-2" style="margin:0; padding:0">
                @include('inc.sidebar')
            </div>
            @include('inc.messages')
            @yield('content')   
        </div>
    @else
        <div id="app">
            @include('inc.navbar')
            <div class="container" style="margin-top:3.6em">
                @include('inc.messages')
                @yield('content')
            </div>
            @include('inc.footer')
        </div>
    @endif
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            $(".clickable-row").click(function(e) {
                if((e.target).tagName == 'INPUT') return true;
                e.preventDefault();
                $("#ck_"+$(this).attr('id')).prop('checked', !$("#ck_"+$(this).attr('id')).prop('checked'));
                window.location = $(this).data("href");
            });
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            var path = window.location.pathname;
            if(path.charAt(path.length-1) == "/") {
                path = path.substring(0, path.length - 1);
            }
            if (path.charAt(0) != "/") {
                path = "/" + path;
            }
            $("#accordion1 a[href*='"+path+"']").addClass("active");
        });
    </script>
</body>
</html>
