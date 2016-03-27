@extends('main_page')

@section('title', 'Check Résultats')

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
                    <h3>Vérification des enregistrements</h3>
                    <p>Il semble y avoir une erreur, veuillez vérifier les enregistrements</p>
                </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2></h2>
                        </div>
                        <div class="x_content row">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-center table-condensed">
                                    <caption></caption>
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Défaut</th>
                                        <th>Etat_2</th>
                                        <th>Description</th>
                                        <th>Commentaires</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($results))
                                        @foreach($results as $result)
                                            <tr data-toggle="modal" data-target=".modal-lg-{{$result->id}}">
                                                <td>{{$result->id}}</td>
                                                <td>{{$result->date}}</td>
                                                <td>{{$result->time}}</td>
                                                <td>{{$result->defaut}}</td>
                                                <td>{{$result->etat_2}}</td>
                                                <td>{{$result->description}}</td>
                                                <td>{{$result->commentaires}}</td>
                                            </tr>
                                            @if(Auth::user())
                                                <div class="modal fade modal-lg-{{$result->id}}" tabindex="-1"
                                                     role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">
                                                                    <span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title">Id : {{$result->id}}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('checkResults') }}" id="comCol"
                                                                      method="post">
                                                                    <div class="form-group">
                                                                        <label for="date">Date</label>
                                                                        <input type="text" class="form-control"
                                                                               value="{{$result->date}}"
                                                                               id="date" name="date">
                                                                        <label for="time">Time</label>
                                                                        <input type="text" class="form-control"
                                                                               value="{{$result->time}}"
                                                                               id="time" name="time">
                                                                        <label for="defaut">Défaut</label>
                                                                        <input type="text" class="form-control"
                                                                               value="{{$result->defaut}}"
                                                                               id="defaut" name="defaut">
                                                                        <label for="etat_2">Etat</label>
                                                                        <input type="text" class="form-control"
                                                                               value="{{$result->etat_2}}"
                                                                               id="etat_2" name="etat_2">
                                                                        <label for="description">Description</label>
                                                                        <input type="text" class="form-control"
                                                                               value="{{$result->description}}"
                                                                               id="description" name="description">
                                                                        <label for="commentaires">Commentaires</label>
                                                                        <input type="text" class="form-control"
                                                                               value="{{$result->commentaires}}"
                                                                               id="commentaires" name="commentaires">
                                                                    </div>
                                                                    <input type="hidden" name="_token"
                                                                           value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="id"
                                                                           value="{{$result->id}}">
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
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>

                                    </tr>
                                    </tfoot>
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
    {{dump($results)}}
@endsection