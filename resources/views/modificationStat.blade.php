@extends('main_page')

@section('title', 'Modification Stats')

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
                    <h3>Base Stats</h3>
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Stats</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content row">
                            <div class="table-responsive">
                                <form action="{{ route('showStats') }}" id="modificationStat"
                                      class="form-group" method="post">
                                    <table class="table table-striped table-hover text-center table-condensed">
                                        <caption>Base Stats</caption>
                                        <thead>
                                        <tr>
                                            @foreach($row1['attributes'] as $key => $value)
                                                <th>{{ $key }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="success">
                                            @foreach($row1['attributes'] as $key => $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                        <tr class="warning">
                                            @foreach($row2['attributes'] as $key => $value)
                                                <td>{{ $value }}</td>
                                            @endforeach

                                        </tr>
                                        <th class="danger" colspan="3">Nouvelle entrée après soustraction</th>
                                        <div class="form-group">
                                            <tr class="danger">
                                                @foreach($row3['attributes'] as $key => $value)
                                                    <td>
                                                        <input class="form-control text-center" style="min-width: 10em"
                                                               name="{{ $key }}"
                                                               type="text"
                                                               value="{{ $value }}">
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </div>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </form>
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
@endsection