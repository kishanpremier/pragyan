<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>
            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>
            {{--<li>
                <a href="#">
            <i class="fa fa-dashboar                            d"></i>
                                    <span>{{ trans('menus.backend.sidebar.subject') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-dashboard"></i>
                                    <span>{{ trans('menus.backend.sidebar.subject') }}</span>
                                </a>
                            </li>--}}
                            <!--            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>-->
                            <!--            {{ renderMenuItems(getMenuItems()) }}-->

                            <li class="treeview"><a href="">
                                    <i class="fa fa-users"></i> 
                                    <span>Class</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a> <ul class="treeview-menu" style="display: none;">
                                    <li class="  ">
                                        <a href="{{url('admin/create')}}">
                                            <i class="fa "></i> 
                                            <span>Add class</span></a>
                                    </li> 
                                    <li class="">
                                        <a href="{{url('admin/classlist')}}">
                                            <i class="fa "></i>
                                            <span>List class</span>
                                        </a>
                                    </li>
                                    
                            </li>
                            </ul><!-- /.sidebar-menu -->
                            </section><!-- /.sidebar -->
                            </aside>