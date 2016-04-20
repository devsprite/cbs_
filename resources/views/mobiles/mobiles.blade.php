@extends('common.base')

@section('title', 'Stats Mobiles')

@section('content')
<div class="right_col" role="main">
    @if( Session::has('error') )
        <div class="row alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    @if( Session::has('success') )
        <div class="row alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Opérateurs CBS</h3>
            </div>
            <div id="reportrange" class="pull-right"
                 style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
            </div>
        </div>
        <div class="clearfix"></div>
        @foreach($mobiles as $mobile)
            @if((isset($mobile[0][0]->mobile) &&  $mobile[0][0]->mobile != ""))

                <div class="row" id="{{ rawurlencode($mobile[0][0]->mobile) }}">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>{{ $mobile[0][0]->mobile }} - {{ $mobile[2] }} défauts - du {{ date( 'j/n/Y', strtotime($startDate ))}}
                                    au {{ date( 'j/n/Y', strtotime($endDate)) }}</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="dashboard-widget-content">
                                    <ul class="list-unstyled timeline widget">
                                        @foreach($mobile[0] as $mob)
                                            <li>
                                                <div class="block">
                                                    <div class="block_content">
                                                        <h2 class="title">
                                                            <a>{{  $mob->symptome }}</a>
                                                        </h2>

                                                        <div class="byline">
                                                            <span>Le {{ date('j-n-Y à H:i', strtotime($mob->heure_de_debut)) }}</span>
                                                            par
                                                            <a>{{ $mob->intervenant }}</a>
                                                            - {{ $mob->numero_canton }}
                                                        </div>
                                                        <p class="excerpt">{{ $mob->commentaires }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>{{ $mobile[0][0]->mobile }} - Répartition des défauts dans le temps</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                                <div class="x-content" style="overflow:hidden;">
                                    <div id="graph_bar_{{ substr($mobile[0][0]->mobile, 7, 2) }}" style="width:100%; height:400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<br>
                <script>
                    $(function () {
                        var day_data_{{ substr($mobile[0][0]->mobile, 7, 2) }} = [
                            @foreach($rangeDate as $d)
                                {
                                    "period": "{{ date( 'j-n-Y', strtotime( $d->date ))}}",
                                @foreach($mobile[1] as $m)
                                    @if($m->date == $d->date)
                                        "Nbr défauts": '{{ $m->count }}',
                                    @endif
                                @endforeach
                                },
                            @endforeach
                        ];
                        Morris.Bar({
                            element: 'graph_bar_{{ substr($mobile[0][0]->mobile, 7, 2) }}',
                            data: day_data_{{ substr($mobile[0][0]->mobile, 7, 2) }},
                            hideHover: 'auto',
                            xkey: 'period',
                            barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                            ykeys: ['Nbr défauts'],
                            labels: ['Nbr défauts'],
                            xLabelAngle: 60
                        });
                    });
                </script>
                @endif
                @endforeach
    </div>
        <!-- /content -->

    <!-- footer content -->
    <footer>
        <div class="">
            <p class="pull-right">Stats CBS - LOPEZ Dominique
                <span class="lead"> <i class="fa fa-paw"></i> Stats CBS</span>
            </p>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
</div>
@endsection

@section('script')
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
@endsection