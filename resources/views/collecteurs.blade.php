@extends('main_page')

@section('title', 'Stats Collecteurs')

@section('content')
    <div class="right_col" role="main">
        @if( Session::has('error') )
            <div class="row alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if( Session::has('success') )
            <div class="row alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div>
            <div class="page-title hidden-print">
                <div class="title_left">
                    <h3>{{ $collecteur }} du {{ date_format(date_create($startDate), 'd-m-Y') }}
                        au {{ date_format(date_create($endDate), 'd-m-Y') }}</h3>
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ $collecteur }}</h2>
                            <div id="reportrange" class="pull-right"
                                 style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content row">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-center table-condensed">
                                    <caption>Temps de saturation : {{ ($collecteurDefauts['totalDuree']['jours'])
                                    ?$collecteurDefauts['totalDuree']['jours']." jour - ":"" }}
                                        {{ $collecteurDefauts['totalDuree']['heures'] }} h
                                        {{ $collecteurDefauts['totalDuree']['minutes'] }} m
                                        {{ $collecteurDefauts['totalDuree']['secondes'] }} s / Nombre d'arrêts : {{ $collecteurDefauts['totalDefaut'] }}</caption>
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Nombre</th>
                                        <th>Durée</th>
                                        <th>Commentaires</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($collecteurDefauts['defauts']))
                                    @foreach($collecteurDefauts['defauts'] as $key => $value)
                                        <tr data-toggle="modal" data-target=".modal-lg-{{$value['id']}}">
                                            <td class="width-1">{{ date('j / m / Y', strtotime($key)) }}</td>
                                            <td class="width-1">{{  $value['nbrDefauts']}}</td>
                                            <td class="width-1">{{  ($value['duree']['heures']!=0)?$value['duree']['heures']." : ":""}}{{$value['duree']['minutes']}} : {{$value['duree']['secondes']}}</td>
                                            <td class="width-2">{{  $value['commentaires']}}</td>
                                        </tr>
                                        @if(Auth::user())
                                            <div class="modal fade modal-lg-{{$value['id']}}" tabindex="-1"
                                                 role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">{{ date('j / m / Y', strtotime($key)) }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('collecteursPost') }}" id="comCol"
                                                                  method="post">
                                                                <div class="form-group">
                                                                    <label for="commentaires">Commentaires</label>
                                                                    <input type="text" class="form-control"
                                                                           value="{{  $value['commentaires']}}"
                                                                           id="commentaires" name="commentaires">
                                                                </div>
                                                                <input type="hidden" name="_token"
                                                                       value="{{ csrf_token() }}">
                                                                <input type="hidden" name="id"
                                                                       value="{{  $value['id']}}">
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Enregistrer
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th>{{ $collecteurDefauts['totalDefaut'] }}</th>
                                        <th>{{ ($collecteurDefauts['totalDuree']['jours'])
                                            ?$collecteurDefauts['totalDuree']['jours']." jour - ":"" }}
                                            {{ $collecteurDefauts['totalDuree']['heures'] }}
                                            h {{ $collecteurDefauts['totalDuree']['minutes'] }}
                                            m {{ $collecteurDefauts['totalDuree']['secondes'] }} s</th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
