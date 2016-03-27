@extends('main_page')

@section('title', 'Données Opérateurs')

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

            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Opérateurs CBS</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content row">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-center table-condensed">
                                    <caption>Opérateurs CBS</caption>
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>heure_de_debut</th>
                                        <th>duree</th>
                                        <th>nombre_agent</th>
                                        <th>intervenant</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;commentaires&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>mobile</th>
                                        <th>symptome</th>
                                        <th>numero_canton</th>
                                        <th>numero_convoyeur</th>
                                        <th>defaut_eds</th>
                                        <th>defaut_tomographe</th>
                                        <th>saturation_chute</th>
                                        <th>cause</th>
                                        <th>mode_de_defaillance</th>
                                        <th>valid</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datasOperateurs as $datasOperateur)
                                        <tr>
                                            <th>{{ $datasOperateur->id }}</th>
                                            <td>{{ substr($datasOperateur->date,0,10) }}</td>
                                            <td>{{ substr($datasOperateur->heure_de_debut,10,10) }}</td>
                                            <td>{{ substr($datasOperateur->duree,10,10) }}</td>
                                            <td>{{ $datasOperateur->nombre_agent }}</td>
                                            <td>{{ $datasOperateur->intervenant }}</td>
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
                                            <td>{{ $datasOperateur->valid }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                            {!! $datasOperateurs->render() !!}
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