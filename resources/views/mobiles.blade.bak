@extends('main_page')

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