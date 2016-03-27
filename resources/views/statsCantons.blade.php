@extends('main_page')

@section('title', 'Stats CBS')

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
                    <h3>Stats cantons du {{ date_format(date_create($startDate), 'd-m-Y') }}
                        au {{ date_format(date_create($endDate), 'd-m-Y') }}</h3>
                </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Stats Cantons</h2>
                            <div id="reportrange" class="pull-right"
                                 style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- /////////////////// -->

                        @foreach($donnees['numero_canton'] as $canton)

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>{{ $canton->numero_canton }} <small>Nombre de défaut{{ ($canton->count>1)?'s':'' }} : {{ $canton->count }}</small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Cantons</th>
                                                        <th>Nombres</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($cantons['defauts'][$canton->numero_canton] as $defauts)
                                                        <tr>
                                                            <td>{{ $defauts->numero_canton }}</td>
                                                            <td>{{ $defauts->count }}</td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Mobiles</th>
                                                        <th>Nombres</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($cantons['mobiles'][$canton->numero_canton] as $mobile)
                                                        <tr>
                                                            <td>{{ $mobile->mobile }}</td>
                                                            <td>{{ $mobile->count }}</td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Défauts</th>
                                                        <th>Nombres</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($cantons['symptomes'][$canton->numero_canton] as $symptome)
                                                        <tr>
                                                            <td>{{ $symptome->symptome }}</td>
                                                            <td>{{ $symptome->count }}</td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-6">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Commentaires</th>
                                                        <th>Nombres</th>
                                                        <th class="width-15">Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($cantons['commentaires'][$canton->numero_canton] as $commentaire)
                                                        @if($commentaire->commentaires != "")
                                                            <tr>
                                                                <td>{{ $commentaire->commentaires }}</td>
                                                                <td>{{ $commentaire->count }}</td>
                                                                <td>{{ date('d-m-Y',strtotime($commentaire->date)) }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div> <!-- -->
                </div>
            </div>
        </div>
    </div>

@endsection