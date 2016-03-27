@extends('main_page')

@section('title', 'Upload files')

@section('content')
        <!-- page content -->
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
                <h3>Mise à jour BDD </h3>
            </div>

        </div>
        <div class="clearfix"></div>
        @if(Auth::user()->email == 'greeftdc@gmail.com')
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="cssload-loader">
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Dropzone</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <p>Déposez vos fichiers, ( Suivi_CBS_Base.xls ), et cliquez sur 'Mise à jour'.</p>

                            <form action="{{ route('form_upload') }}" method="post" class="dropzone"
                                  enctype="multipart/form-data"
                                  style="border: 1px solid #e5e5e5; height: 300px; ">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <a href="{{ route('import') }}" id="submit" class="btn btn-info" onclick="">Mise à jour</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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

