@extends('main_page')

@section('title', 'Données Automate')

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
                                    <caption>Logs automate</caption>
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Date</th>
                                        <th>Heure</th>
                                        <th>Défaut</th>
                                        <th>Description</th>
                                        <th>Etat_1</th>
                                        <th>Etat_2</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($defautsAutomate as $defautAutomate)
                                        <tr>
                                            <td>{{ $defautAutomate->id }}</td>
                                            <td>{{ $defautAutomate->date }}</td>
                                            <td>{{ $defautAutomate->time }}</td>
                                            <td>{{ $defautAutomate->defaut }}</td>
                                            <td>{{ $defautAutomate->description }}</td>
                                            <td>{{ $defautAutomate->etat_1 }}</td>
                                            <td>{{ $defautAutomate->etat_2 }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                            {!! $defautsAutomate->render() !!}
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