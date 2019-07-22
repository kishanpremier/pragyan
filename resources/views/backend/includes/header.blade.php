<header class="main-header">
    
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
           {{ substr(app_name(), 0, 1) }}
        </span>

        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
           {{--  @php
                 $settings = settings();
            @endphp
            @if($settings->logo)
                <img height="48" width="226" class="navbar-brand" src="{{asset('img/ic_logo.png')}}">
            @else --}}
               <img  class="navbar-brand" src="{{asset('img/ic_logo_small.png')}}">
           {{--  @endif --}}
        </span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ access()->user()->picture }}" class="user-image" alt="User Avatar"/>
                        <span class="hidden-xs">{{ access()->user()->first_name }}</span>
                        <div class="clearfix"></div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="user-header">
                            <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Avatar" />
                            <p>
                                {{-- access()->user()->name }} - {{ implode(", ", access()->user()->roles->lists('name')->toArray()) --}}
                                <small>{{ trans('strings.backend.general.member_since') }} {{ access()->user()->created_at->format("m/d/Y") }}</small>
                            </p>
                        </li>

                        <li class="user-body">
                            <div class="col-xs-12 text-center">
                                {{ link_to_route("admin.profile.edit", 'Edit Profile') }}
                            </div>
                        </li>
                        <li class="user-body border-left">
                            <div class="col-xs-12 text-center">
                                {{ link_to_route('admin.access.user.change-password','Change Password', access()->user()->id) }}
                            </div>
                            {{-- <div class="col-xs-4 text-center">
                                {{ link_to_route('dashboard', 'Link') }}
                            </div> --}}
                        </li>

                        <li class="user-footer">
                            
                            <div class="pull-right">
                                <a href="{!! route('frontend.auth.logout') !!}" class="btn btn-danger btn-flat">
                                    <i class="fa fa-sign-out"></i>
                                    {{ trans('navs.general.logout') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-custom-menu -->
    </nav>
</header>
