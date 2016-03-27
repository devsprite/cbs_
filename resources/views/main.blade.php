<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stats CBS</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/maps/jquery-jvectormap-2.0.1.css') }}"/>
    <link href="{{ URL::asset('css/icheck/flat/green.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/floatexamples.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ URL::asset('css/print.css') }}" rel="stylesheet" media="print">

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/nprogress.js') }}"></script>
    <script>
        NProgress.start();
    </script>

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
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                @include('menu_prile')
                <br/>
                @include('sidebar_menu')
            </div>
        </div>
        @include('top_navigation')
        <div class="right_col" role="main">
@if( Session::has('error') )
        <div class="row alert alert-danger">{{ Session::get('error') }}</div>
@endif
@if( Session::has('success') )
        <div class="row alert alert-success">{{ Session::get('success') }}</div>
@endif
@yield('content')
        </div>
    </div>
</div>

<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<!-- gauge js -->
<script type="text/javascript" src="{{ URL::asset('js/gauge/gauge.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/gauge/gauge_demo.js') }}"></script>
<!-- chart js -->
<script src="{{ URL::asset('js/chartjs/chart.min.js') }}"></script>
<!-- bootstrap progress js -->
<script src="{{ URL::asset('js/progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ URL::asset('js/nicescroll/jquery.nicescroll.min.js') }}"></script>
<!-- icheck -->
<script src="{{ URL::asset('js/icheck/icheck.min.js') }}"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{ URL::asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/datepicker/daterangepicker.js') }}"></script>
<!-- sparkline -->
<script src="{{ URL::asset('js/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset('js/custom.js') }}"></script>
<!-- flot js -->
<!--[if lte IE 8]>
<script type="text/javascript" src="{{ URL::asset('js/excanvas.min.js') }}"></script><![endif]-->
<script type="text/javascript" src="{{ URL::asset('js/flot/jquery.flot.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/flot/jquery.flot.pie.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/flot/jquery.flot.orderBars.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/flot/jquery.flot.time.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/flot/date.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/flot/jquery.flot.spline.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/flot/jquery.flot.stack.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/flot/curvedLines.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/flot/jquery.flot.resize.js') }}"></script>
<!--  DataTable  -->
<script src="{{ URL::asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tableOpe').DataTable({
            createdRow: function (row) {
                $('td', row).attr('tabindex', 0);
            },
            "pageLength": 10,
            "order": [[ 0, 'desc' ]]
        });
    });
</script>
<!-- flot -->
<script type="text/javascript">
    //define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
    var chartColours = ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'];

    //generate random number for charts
    randNum = function () {
        return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
    }
    $(function () {
        var d1 = [];
        var d12 = [];

        //here we generate data for chart
        for (var i = 0; i < 30; i++) {
            d12.push([new Date(Date.today().add(i).days()).getTime(), randNum() + i + i + 10]);
            //    d2.push([new Date(Date.today().add(i).days()).getTime(), randNum()]);
        }
        @foreach($graphInterventions as $data)
            d1.push([{{ strtotime($data->date).'000' }}, {{  $data->count }} ]);
        @endforeach
                var chartMinDate = d1[0][0]; //first day
        var chartMaxDate = d1['{{ count($graphInterventions) - 1 }}'][0]; //last day

        var tickSize = [1, "day"];
        var tformat = "%d/%m/%y";

        //graph options
        var options = {
            grid: {
                show: true,
                aboveData: true,
                color: "#3f3f3f",
                labelMargin: 10,
                axisMargin: 0,
                borderWidth: 0,
                borderColor: null,
                minBorderMargin: 5,
                clickable: true,
                hoverable: true,
                autoHighlight: true,
                mouseActiveRadius: 100
            },
            series: {
                lines: {
                    show: true,
                    fill: true,
                    lineWidth: 2,
                    steps: false
                },
                points: {
                    show: true,
                    radius: 4.5,
                    symbol: "circle",
                    lineWidth: 3.0
                }
            },
            legend: {
                position: "ne",
                margin: [0, -25],
                noColumns: 0,
                labelBoxBorderColor: null,
                labelFormatter: function (label, series) {
                    // just add some space to labes
                    return label + '&nbsp;&nbsp;';
                },
                width: 40,
                height: 1
            },
            colors: chartColours,
            shadowSize: 0,
            tooltip: true, //activate tooltip
            tooltipOpts: {
                content: "%s: %y.0",
                xDateFormat: "%d/%m",
                shifts: {
                    x: -30,
                    y: -50
                },
                defaultTheme: false
            },
            yaxis: {
                min: 0
            },
            xaxis: {
                mode: "time",
                minTickSize: tickSize,
                timeformat: tformat,
                min: chartMinDate,
                max: chartMaxDate
            }
        };
        var plot = $.plot($("#placeholder33x"), [{
            label: "Interventions",
            data: d1,
            lines: {
                fillColor: "rgba(150, 202, 89, 0.12)"
            }, //#96CA59 rgba(150, 202, 89, 0.42)
            points: {
                fillColor: "#fff"
            }
        }], options);
    });
</script>
<!-- /flot -->
<script>
    $(document).ready(function () {
        // [17, 74, 6, 39, 20, 85, 7]
        //[82, 23, 66, 9, 99, 6, 2]

        var data1 = [
            @foreach($graphInterventions as $data)
            {{ '[gd(' . substr($data->date, 0, 4) .',' . substr($data->date, 5, 2) . ',' . substr($data->date, 8, 2) . '), ' . $data->count . '], '}}
            @endforeach
        ];

        var data2 = [
            @foreach($statsBagages as $data)
            {{ '[gd(' . substr($data->date, 0, 4) .',' . substr($data->date, 5, 2) . ',' . substr($data->date, 8, 2) . '), ' . $data->nombre_de_bagages_inspecte_par_eds01 . '], '}}
            @endforeach
    ];

        $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
            data2
        ], {
            series: {
                lines: {
                    show: true,
                    fill: true,
                    lineWidth: 2,
                    steps: false
                },
                splines: {
                    show: false,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
                points: {
                    show: true,
                    radius: 2.5,
                    symbol: "circle",
                    lineWidth: 3.0
                },
                shadowSize: 2
            },
            grid: {
                verticalLines: true,
                hoverable: true,
                clickable: true,
                tickColor: "#d5d5d5",
                borderWidth: 1,
                color: '#fff'
            },
            colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
            xaxis: {
                tickColor: "rgba(51, 51, 51, 0.06)",
                mode: "time",
                tickSize: [1, "day"],
                tickLength: 1,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
                mode: "time", timeformat: "%d/%m"
            },
            yaxis: {
                ticks: 8,
                tickColor: "rgba(51, 51, 51, 0.06)",
            },
            tooltip: false,
        });

        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }
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
<script>
    NProgress.done();
</script>
<!-- /datepicker -->
<!-- sparkline -->
<script>
    $('document').ready(function () {
        $(".sparkline_one").sparkline([
            @foreach($statsBagages as $data)
                {{ $data->envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de.',' }}
            @endforeach
        ], {
            type: 'bar',
            height: '125',
            barWidth: 9,
            colorMap: {
                '{{ intval($sumDatas['totalRejetCBS'][0]->moyenne) }}:200': '#9B59B6'
            },
            barSpacing: 2,
            barColor: '#26B99A',
            tooltipSuffix: ''
        });

        $(".sparkline_two").sparkline([
            @foreach($statsBagages as $data)
                {{ $data->envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri_l .',' }}
            @endforeach
            ], {
            type: 'bar',
            height: '125',
            barWidth: 9,
            colorMap: {
                '{{ intval($sumDatas['totalRejetLigne1'][0]->moyenne) }}:250': '#9B59B6',
            },
            barSpacing: 2,
            barColor: '#26B99A',
            tooltipSuffix: ''
        });

        $(".sparkline_tree").sparkline([
            @foreach($statsBagages as $data)
                {{ $data->envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri.',' }}
            @endforeach
            ], {
            type: 'bar',
            height: '125',
            barWidth: 9,
            colorMap: {
                '{{ intval($sumDatas['totalRejetLigne2'][0]->moyenne) }}:250': '#9B59B6'
            },
            barSpacing: 2,
            barColor: '#26B99A',
            tooltipSuffix: ''
        });

        $(".sparkline_four").sparkline([
            @foreach($statsBagages as $data)
                {{ number_format((float)($data->envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de/(
                    $data->nombre_de_bagages_injectes_par_la_ligne_1 +
                    $data->nombre_de_bagages_injectes_par_la_ligne_2 +
                    $data->nombre_de_bagages_injectes_depuis_la_ligne_correspondance +
                    $data->nombre_de_bagages_injectes_depuis_la_ligne_hors_gabarit + 1
                )*100), 1, '.', '') .',' }}
            @endforeach
            ], {
            type: 'bar',
            height: '125',
            barWidth: 9,
            colorMap: {
                '4: 250': '#9B59B6'
            },
            barSpacing: 2,
            barColor: '#26B99A',
            tooltipSuffix: ' %'
        });

    });
</script>
<!-- /sparkline -->
<!-- /footer content --><!-- Piwik -->
<script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(["setDomains", ["*.cbs.cu.cc","*.www.cbs.cu.cc"]]);
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//www.cbs.cu.cc/piwik/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', 1]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<noscript><p><img src="//www.cbs.cu.cc/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->

</body>
</html>

