@extends('main')

@section('content')
    <!-- page content -->
    <!-- First row top tiles -->
    <div class="row tile_count">
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-user"></i> Total bagages : </span>
                <div class="count">{{ $sumDatas['totalBagages'][0]->total ? $sumDatas['totalBagages'][0]->total: '0' }}</div>
            </div>
        </div>
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-user"></i> Total interventions</span>
                <div class="count">{{ isset($sumDatas['totalInterventions']) ? $sumDatas['totalInterventions'] : '0'}}</div>
                <span class="count_bottom"><i class="green"></i> Total période</span>
            </div>
        </div>
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-warning"></i> Défaut Incendie</span>
                <div class="count">{{ date('H:i:s', $defautsIncendie['totalDuree'] ) }}</div>
                <span class="count_bottom">Nombre de défaut : {{ $defautsIncendie['totalDefaut'] }}</span>
            </div>
        </div>
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-car"></i> Mobiles</span>
                <div class="count">{{ isset($sumDatas['totalInterMobiles']) ? $sumDatas['totalInterMobiles'] : '0' }}</div>
            <span class="count_bottom">Intervention{{  isset($sumDatas['totalInterMobiles']) ? ($sumDatas['totalInterMobiles'] > 1) ? 's' : '' : ''}}
                sur la période</span>
            </div>
        </div>
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-gear"></i> Tomographe</span>
                <div class="count">{{ isset($sumDatas['totalInterTomo']) ? $sumDatas['totalInterTomo'] : '0'}}</div>
            <span class="count_bottom">Intervention{{ isset($sumDatas['totalInterTomo']) ? ($sumDatas['totalInterTomo'] > 1) ? 's' : '' : ''}}
                sur la période</span>
            </div>
        </div>
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-gear"></i> EDS</span>
                <div class="count">{{ isset($sumDatas['totalInterEds']) ? $sumDatas['totalInterEds'] : '0' }}</div>
            <span class="count_bottom">Intervention{{  isset($sumDatas['totalInterEds']) ? ($sumDatas['totalInterEds'] > 1) ? 's' : '' : ''}}
                sur la période</span>
            </div>
        </div>
    </div>
    <!-- / First row top tiles -->
    <!-- Second row top tiles -->
    <div class="row tile_count">
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-plane"></i> Temps d'arrêt Ligne 1</span>
                <div class="count">{{ ($defautsTRA100['totalDuree']['jours'])
                                            ?$defautsTRA100['totalDuree']['jours']."j ":"" }}
                    {{ ($defautsTRA100['totalDuree']['heures'])?$defautsTRA100['totalDuree']['heures'].'h ':'' }}
                    {{ ($defautsTRA100['totalDuree']['minutes'])?$defautsTRA100['totalDuree']['minutes'].'m ':'' }}
                    {{ ($defautsTRA100['totalDuree']['secondes'])?$defautsTRA100['totalDuree']['secondes'].'s':'' }}</div>
                <span class="count_bottom">Ligne toutes compagnies</span>
            </div>
        </div>
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-plane"></i> Temps d'arrêt Ligne 2</span>
                <div class="count">{{ ($defautsTRA110['totalDuree']['jours'])
                                            ?$defautsTRA110['totalDuree']['jours']."j ":"" }}
                    {{ ($defautsTRA110['totalDuree']['heures'])?$defautsTRA110['totalDuree']['heures'].'h ':'' }}
                    {{ ($defautsTRA110['totalDuree']['minutes'])?$defautsTRA110['totalDuree']['minutes'].'m ':'' }}
                    {{ ($defautsTRA110['totalDuree']['secondes'])?$defautsTRA110['totalDuree']['secondes'].'s':'' }}</div>
                <span class="count_bottom">Ligne Air France</span>
            </div>
        </div>
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-warning"></i> Dégradé Ultime</span>
                <div class="count">{{ ($defautsMDU['totalDuree']['jours'])
                                            ?$defautsMDU['totalDuree']['jours']."j ":"" }}
                    {{ ($defautsMDU['totalDuree']['heures'])?$defautsMDU['totalDuree']['heures'].'h ':'' }}
                    {{ ($defautsMDU['totalDuree']['minutes'])?$defautsMDU['totalDuree']['minutes'].'m ':'' }}
                    {{ ($defautsMDU['totalDuree']['secondes'])?$defautsMDU['totalDuree']['secondes'].'s':'' }}</div>
            </div>
        </div>
        <div class="animated flipInY col-md-4 col-sm-8 col-xs-8 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-cab"></i> Top Mobiles</span>
                <div class="">
                    @foreach( $defautsMobiles['defauts'] as $mobile => $defautsMobile)
                        <a href="{{ route('mobiles').'#'.rawurlencode($mobile) }}"><span>{{ $mobile }} : {{ $defautsMobile['total'] }} défauts.
                        ({{ $defautsMobile[0]->count }} défauts : {{ $defautsMobile[0]->symptome }})</span></a>
                    @endforeach
                </div>
                <span class="count_bottom"></span>
            </div>
        </div>
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count hidden-print">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-play-circle-o"> Dernières mises à jour</i></span>
                <div class="count_bottom">
                    <div>{{ date('d/m/Y', strtotime($derniereMaJ['operateurs']->date)) }} - Opérateurs</div>
                    <div>{{ date('d/m/Y', strtotime($derniereMaJ['automate']->date)) }} - Automate</div>
                    <div>{{ date('d/m/Y', strtotime($derniereMaJ['stats']->date)) }} - Stats</div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Second row top title -->
    <br>
    <div class="row bg-white">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">
                <div class="row x_title">
                    <div class="col-md-8">
                        <h3>Total bagages
                            Bagages sécurisés par le CBS du {{ date_format(date_create($startDate), 'd-m-Y') }}
                            au {{ date_format(date_create($endDate), 'd-m-Y') }}
                        </h3>
                    </div>
                    <div class="col-md-4">
                        <div id="reportrange" class="pull-right"
                             style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                    <div style="width: 100%;">
                        <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row bg-white">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Interventions opérateurs</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="tableOpe" class="table table-hover">
                            <caption>Opérateurs CBS</caption>
                            <thead>
                            <tr>
                                <th class="width-7">Date</th>
                                <th class="width-5">Durée</th>
                                <th class="width-50">Commentaires</th>
                                <th class="width-4">Mobile</th>
                                <th class="width-4">Sympt.</th>
                                <th class="width-4">Canton</th>
                                <th class="width-4">Convoyeur</th>
                                <th class="width-4">Eds</th>
                                <th class="width-4">Tomo</th>
                                <th class="width-5">Chute</th>
                                <th class="width-4">Cause</th>
                                <th class="width-4">Mode</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datasOperateurs as $datasOperateur)
                                <tr>

                                    <td>{{ $datasOperateur->date }}
                                        <br/>{{ date( ' H\hi ', strtotime($datasOperateur->heure_de_debut)) }}</td>
                                    <td>{{ substr($datasOperateur->duree,14,10) }}</td>
                                    <td>{{ $datasOperateur->commentaires }}</td>
                                    <td>{{ $datasOperateur->mobile }}</td>
                                    <td>{{ $datasOperateur->symptome }}</td>
                                    <td>{{ $datasOperateur->numero_canton }}</td>
                                    <td>{{ $datasOperateur->numero_convoyeur }}</td>
                                    <td>{{ $datasOperateur->defaut_eds }}</td>
                                    <td>{{ $datasOperateur->defaut_tomographe }}</td>
                                    <td>{{ $datasOperateur->saturation_chute }}</td>
                                    <td>{{ $datasOperateur->cause }}</td>
                                    <td>{{ $datasOperateur->mode_de_defaillance }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row bg-white">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Interventions opérateurs</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="demo-container" style="height:280px">
                            <div id="placeholder33x" class="demo-placeholder"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row bg-white">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <div class="dashboard_graph">
                <div class="x_title">
                    <h2>CBS</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-6 bg-white">
                    <div>
                        <p>Ligne 1 : {{ $sumDatas['totalLigne1'][0]->total }} bagages <span class="badge pull-right">{{ intval(( $sumDatas['totalLigne1'][0]->total / $sumDatas['totalBagages'][0]->total ) * 100) }}
                                %</span></p>
                        <div class="">
                            <div class="progress progress_sm" style="width: 100%;">
                                <div class="progress-bar bg-green" role="progressbar"
                                     data-transitiongoal="{{ intval(( $sumDatas['totalLigne1'][0]->total / $sumDatas['totalBagages'][0]->total ) * 100) }}"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>Ligne 2 : {{ $sumDatas['totalLigne2'][0]->total }} bagages <span class="badge pull-right">{{ intval(( $sumDatas['totalLigne2'][0]->total / $sumDatas['totalBagages'][0]->total ) * 100) }}
                                %</span></p>
                        <div class="">
                            <div class="progress progress_sm" style="width: 100%;">
                                <div class="progress-bar bg-green" role="progressbar"
                                     data-transitiongoal="{{ intval(( $sumDatas['totalLigne2'][0]->total / $sumDatas['totalBagages'][0]->total ) * 100) }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-6 bg-white">
                    <div>
                        <p>Rejet : {{ $sumDatas['totalRejet'][0]->total }} bagages <span class="badge pull-right">{{ intval(( $sumDatas['totalRejet'][0]->total / $sumDatas['totalBagages'][0]->total ) * 100) }}
                                %</span></p>
                        <div class="">
                            <div class="progress progress_sm" style="width: 100%;">
                                <div class="progress-bar bg-green" role="progressbar"
                                     data-transitiongoal="{{ intval(( $sumDatas['totalRejet'][0]->total / $sumDatas['totalBagages'][0]->total ) * 100) }}"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>Tomographe : {{ $sumDatas['totalTomo'][0]->total }} bagages inspectés<span
                                    class="badge pull-right">{{ intval(( $sumDatas['totalTomo'][0]->total / $sumDatas['totalBagages'][0]->total ) * 100) }}
                                %</span></p>
                        <div class="">
                            <div class="progress progress_sm" style="width: 100%;">
                                <div class="progress-bar bg-green" role="progressbar"
                                     data-transitiongoal="{{ intval(( $sumDatas['totalTomo'][0]->total / $sumDatas['totalBagages'][0]->total ) * 100) }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row bg-white">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_title">
                <h2>Perte de tri
                    <small> CBS ,ligne 1, ligne 2</small>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-6 col-lg-6" style="overflow:hidden;">
                            <span class="sparkline_two" style="height: 160px; padding: 10px 25px;">
                                <canvas width="200" height="60"
                                        style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                            </span>
                        <h4 style="margin:18px">Perte de tri ligne 1
                            - {{ intval($sumDatas['totalRejetLigne1'][0]->moyenne) }} bagages en moyenne</h4>
                    </div>
                    <div class="col-md-6 col-lg-6" style="overflow:hidden;">
                                <span class="sparkline_tree" style="height: 160px; padding: 10px 25px;">
                                    <canvas width="200" height="60"
                                            style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                        <h4 style="margin:18px">Perte de tri ligne 2
                            - {{ intval($sumDatas['totalRejetLigne2'][0]->moyenne) }} bagages en moyenne</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6" style="overflow:hidden;">
                            <span class="sparkline_one" style="height: 160px; padding: 10px 25px;">
                                <canvas width="200" height="60"
                                        style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                            </span>
                        <h4 style="margin:18px">Perte de tri totale
                            - {{ intval($sumDatas['totalRejetCBS'][0]->moyenne) }}
                            bagages en moyenne</h4>
                    </div>
                    <div class="col-md-6 col-lg-6" style="overflow:hidden;">
                            <span class="sparkline_four" style="height: 160px; padding: 10px 25px;">
                                <canvas width="200" height="60"
                                        style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                            </span>
                        <h4 style="margin:18px">Perte de tri convoyeurs et mobiles en %</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- footer content -->
    <footer>
        <div class="row">
            <p class="pull-right">Stats CBS - LOPEZ Dominique <span class="lead"> <i
                            class="fa fa-paw"></i> Stats CBS</span>
            </p>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
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

    <!-- page content -->
@endsection
