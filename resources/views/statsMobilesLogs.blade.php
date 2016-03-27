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
                    <h3>Stats mobiles</h3>
                </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Mobiles - logs automate</h2>
                            <div id="reportrange" class="pull-right"
                                 style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- /////////////////// -->
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="example" class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Mobiles</th>
                                            @for($i=10; $i>=0 ; $i--)
                                                <th class="text-center">{{ date('F',mktime(0, 0, 0, date("m")-$i, date("d"),   date("Y"))) }}</th>
                                            @endfor
                                            <th class="text-center">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($mobiles as $mobile)
                                            <tr>
                                                <td>{{(isset($mobile[0]->defaut))?"Mobile " . str_pad(substr($mobile[0]->defaut, 11, 2), 2, "0", STR_PAD_LEFT):""}}</td>
                                                <?php $cpt = 0 ?>
                                                @for($i=10; $i>=0 ; $i--)
                                                    <td class="text-center">
                                                        @foreach($mobile as $c)
                                                            @if(isset($c->date) && (date('n', strtotime($c->date)) == date('n',mktime(0, 0, 0, date("m")-$i, date("d"),   date("Y")))) )
                                                                {{ (int)($c->count/2) }}
                                                                <?php $cpt += (int)($c->count/2) ?>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endfor
                                                <th class="text-center">{{ $cpt }}</th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection