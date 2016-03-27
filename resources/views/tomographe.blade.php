@extends('main_page')

@section('title', 'Stats Tomographe')

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
                    <h3>Tomographe</h3>
                </div>
                <div id="reportrange" class="pull-right"
                     style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                    <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- content -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Log Automate - Total défauts : {{ $tomo['totalDefaut'] }}, total durée : {{ date('H:i:s', $tomo['totalDuree'] ) }}</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <div class="x-content" style="">
                                        <div id="tomographe" style="width:100%; height:400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <script>
                        $(function () {
                            var day_data_tomo = [
                                    @foreach($rangeDate as $d)
                                        {
                                    "period": "{{ date( 'j-n-Y', strtotime( $d->date ))}}",
                                    @foreach($tomo as $key => $value)
                                        @if($key == $d->date)
                                            "Nbr défauts": '{{ $value['Total'] }}',
                                            "Durée":'{{ ( date('H', strtotime( $value['dureeDefaut']) )*60) + date('i', strtotime( $value['dureeDefaut']) )}}'
                                        @endif
                                    @endforeach
                                },
                                @endforeach
                            ];
                            Morris.Bar({
                                element: 'tomographe',
                                data: day_data_tomo,
                                hideHover: 'auto',
                                xkey: 'period',
                                barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                                ykeys: ['Nbr défauts', 'Durée'],
                                labels: ['Nbr défauts', 'Durée (en mn)'],
                                xLabelAngle: 60
                            });
                        });
                    </script>
        </div>
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


@endsection