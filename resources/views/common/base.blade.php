<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Stats CBS')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/icheck/flat/green.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/print.css') }}" rel="stylesheet" media="print">

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="{{ URL::asset('../assets/js/ie8-responsive-file-warning.js') }}"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container hidden-print">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                @include('common.menu_prile')
                <br/>
                @include('common.sidebar_menu')
            </div>
        </div>
        @include('common.top_navigation')
    </div>
    <!-- Content -->
    @yield('content')
    <!-- /Content -->
</div>
<!-- Script -->
@yield('script')
<!-- /Script -->

<!-- Piwik -->
<script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(["setDomains", ["*.cbs.cu.cc", "*.www.cbs.cu.cc"]]);
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function () {
        var u = "//www.cbs.cu.cc/piwik/";
        _paq.push(['setTrackerUrl', u + 'piwik.php']);
        _paq.push(['setSiteId', 1]);
        var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
        g.type = 'text/javascript';
        g.async = true;
        g.defer = true;
        g.src = u + 'piwik.js';
        s.parentNode.insertBefore(g, s);
    })();
</script>
<noscript><p><img src="//www.cbs.cu.cc/piwik/piwik.php?idsite=1" style="border:0;" alt=""/></p></noscript>
<!-- End Piwik Code -->

</body>
</html>
