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
                @include('menu_prile')
                <br/>
                @include('sidebar_menu')
            </div>
        </div>
        @include('top_navigation')
    </div>
    <!-- Content -->
    @yield('content')
            <!-- /Content -->
</div>

<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<!-- chart js -->
<script src="{{ URL::asset('js/chartjs/chart.min.js') }}"></script>
<!-- bootstrap progress js -->
<script src="{{ URL::asset('js/progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ URL::asset('js/nicescroll/jquery.nicescroll.min.js') }}"></script>
<!-- icheck -->
<script src="{{ URL::asset('js/icheck/icheck.min.js') }}"></script>
<script src="{{ URL::asset('js/custom.js') }}"></script>
<!-- dropzone -->
<script src="{{ URL::asset('js/dropzone/dropzone.js') }}"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{ URL::asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/datepicker/daterangepicker.js') }}"></script>
<!-- sparkline -->
<script src="{{ URL::asset('js/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset('js/moris/raphael-min.js') }}"></script>
<script src="{{ URL::asset('js/moris/morris.js') }}"></script>

<!--  DataTable  -->
<script src="{{ URL::asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            createdRow: function (row) {
                $('td', row).attr('tabindex', 0);
            },
            "pageLength": 50,
        });
    });
</script>
<!-- datepicker -->
<script type="text/javascript">
    $(document).ready(function () {
        var cb = function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
        }

        var optionSet1 = {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2019',
            dateLimit: {
                days: 365
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                '7 derniers jours': [moment().subtract(6, 'days'), moment()],
                '30 derniers jours': [moment().subtract(29, 'days'), moment()],
                'Mois en cours': [moment().startOf('month'), moment().endOf('month')],
                'Mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM-DD-YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Valider',
                cancelLabel: 'Reset',
                fromLabel: 'De',
                toLabel: 'à',
                customRangeLabel: 'Personnalisé',
                daysOfWeek: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
                firstDay: 1
            }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function () {
            console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function () {
            console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
            console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
            console.log("cancel event fired");
        });
        $('#options1').click(function () {
            $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function () {
            $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function () {
            $('#reportrange').data('daterangepicker').remove();
        });
    });
</script>

<!-- /datepicker -->

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
