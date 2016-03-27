        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
@if(Auth::user())
                                <img src="{{ 'http://www.gravatar.com/avatar/' . md5( strtolower( trim( Auth::user()->email ) ) )  }}" alt="">{{ Auth::user()->name }}
@endif
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
@if (Auth::guest())
                                <li><a href="{{ route('login') }}">Login</a></li>
@else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                                    <ul class="" role="menu">
                                        <li><a href="{{ route('logout') }}">Logout</a></li>
                                    </ul>
                                </li>
@endif
                            </ul>
                        </li>
                    </ul>
                    <input type="text" name="recherche" id="recherche" class="form-control hidden-print" placeholder="Recherche dans le fichier opérateurs CBS et les logs automate" autofocus>
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    <div id="valret"></div>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
