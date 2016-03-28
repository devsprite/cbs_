@extends('header')

@section('content')
    <body style="background:#F7F7F7;">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a un problème avec vos identifiants.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">
                <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('/auth/login') }}">
                    <h1>Login Form</h1>

                    <div>
                        <input type="email" class="form-control" name="email" placeholder="email"
                               value="{{ old('email') }}" required=""/>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div>
                        <button type="submit" class="btn btn-primary pull-left" style="margin-right: 15px;">
                            Login
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">

                        <p class="change_link">Nouveau ?
                            <a href="#toregister" class="to_register"> Créer un compte </a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <a href="{{ route('home') }}">

                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Stats CBS</h1>

                                <p>LOPEZ Dominique.</p>
                            </a>
                        </div>
                    </div>
                </form>
                <!-- form -->
            </section>
            <!-- content -->
        </div>
        <div id="register" class="animate form">
            <section class="login_content">
                <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('/auth/register') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <h1>Créer un compte</h1>

                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" name="name"
                               value="{{ old('name') }}"/>
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="" name="email"
                               value="{{ old('email') }}"/>
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password confirmation" required=""
                               name="password_confirmation">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                            Login
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">

                        <p class="change_link">Déjà inscrit ?
                            <a href="#tologin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <a href="{{ route('home') }}">
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Stats CBS</h1>

                                <p>LOPEZ Dominique</p>
                            </a>
                        </div>
                    </div>
                </form>
                <!-- form -->
            </section>
            <!-- content -->
        </div>
    </div>

    </body>

    </html>
@endsection