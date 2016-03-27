@extends('main_page')

@section('title', 'Stats Dégradé Ultime')

@section('content')
<div class="right_col" role="main">
@if( Session::has('error') )
            <div class="row alert alert-danger">{{ Session::get('error') }}</div>
@endif
@if( Session::has('success') )
            <div class="row alert alert-success">{{ Session::get('success') }}</div>
@endif
            <div class="row">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Mode dégradé ultime</h3>
                    </div>
                </div>
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                    <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Log Automate - Total défauts : {{ $mdu['totalDefaut'] }}, total durée : {{ date('H:i:s', $mdu['totalDuree'] ) }}</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                            <div class="x-content" style="">
                                <div id="mdu" style="width:100%; height:400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <script>
                $(function () {
                    var day_data_mdu = [
@foreach($rangeDate as $d)
                                {   "period": '{{ date( 'j-n-Y', strtotime( $d->date )) }}',
@foreach($mdu as $key => $value)
@if($key == $d->date)
                                    "Nbr défauts": '{{ $value['Total'] }}',
                                    "Durée": '{{ ( date('H', strtotime( $value['dureeDefaut']) )*60) + date('i', strtotime( $value['dureeDefaut']) )}}'
@endif
@endforeach
                                                            },
@endforeach
                    ];
                    Morris.Bar({
                        element: 'mdu',
                        data: day_data_mdu,
                        hideHover: 'auto',
                        xkey: 'period',
                        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                        ykeys: ['Nbr défauts', 'Durée'],
                        labels: ['Nbr défauts', 'Durée (en mn)'],
                        xLabelAngle: 60
                    });
                });
            </script>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Notes des opérateurs du CBS</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="dashboard-widget-content">
                                <ul class="list-unstyled timeline widget">
@foreach($mduNotes as $m)
@foreach($m as $mdu)
                                    <li>
                                        <div class="block">
                                            <div class="block_content">
                                                <h2 class=@if($mdu->cause == 'MODE Dégradé ultime') "title mdu alert alert-warning" data-toggle="modal" data-target=".modal-lg-{{ $mdu->id }}">@else"title">@endif<a>{{  date('d/m/Y', strtotime( $mdu->date ) ) }} - {{ $mdu->cause }}</a>@if($mdu->cause == 'MODE Dégradé ultime') - {{ strtolower( $mdu->commentaires ) }}@endif</h2>
                                                <div class="byline">
                                                    <span>Le {{ date('j-n-Y à H:i', strtotime($mdu->heure_de_debut)) }}</span> par <a>{{ $mdu->intervenant }}</a>
                                                </div>
                                                <p class="excerpt">{{ $mdu->commentaires }}</p>
                                            </div>
                                        </div>
                                    </li>
@if(Auth::user())
                                    <div class="modal fade modal-lg-{{ $mdu->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">{{ $mdu->cause }} du {{ date('j-n-Y à H:i', strtotime($mdu->heure_de_debut)) }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('mdu') }}" id="comMDU" method="post">
                                                        <div class="form-group">
                                                            <label for="commentaires">Commentaires</label>
                                                            <input type="text" class="form-control" value="{{ $mdu->commentaires }}" id="commentaires" name="commentaires">
                                                        </div>
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="id" value="{{ $mdu->id }}">
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
@endif
@endforeach
@endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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
