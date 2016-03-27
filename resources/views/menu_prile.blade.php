                <!-- menu prile quick info -->
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{ route('home') }}" class="site_title"><i class="fa fa-paw"></i><span> Stats CBS</span></a>
                </div>
                <div class="clearfix"></div>
                <div class="profile">
@if(Auth::user())
                    <div class="profile_pic">
                        <img src="{{ 'http://www.gravatar.com/avatar/' . md5( strtolower( trim( Auth::user()->email ) ) )  }}" alt="gravatar" class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bonjour,</span>
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
@endif
                </div>
                <!-- /menu prile quick info -->
