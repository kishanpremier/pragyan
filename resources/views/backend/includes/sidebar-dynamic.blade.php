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
            <i class="fa fa-dashboard"></i>
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
                            <!--            {{renderMenuItems(getMenuItems()) }}-->

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
                            </ul>
            {{--<li class="treeview"><a href="">
                    <i class="fa fa-users"></i>
                    <span>School</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a> <ul class="treeview-menu" style="display: none;">
                    <li class="  ">
                        <a href="{{url('admin/schoolcreate')}}">
                            <i class="fa "></i>
                            <span>Add School</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('admin/schoolList')}}">
                            <i class="fa "></i>
                            <span>List School</span>
                        </a>
                    </li>
                </ul>
            </li><!-- /.sidebar-menu -->--}}
                    <li class="treeview"><a href="">
                            <i class="fa fa-users"></i>
                            <span>Board</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a> <ul class="treeview-menu" style="display: none;">
                            <li class="  ">
                                <a href="{{url('admin/schoolboardcreate')}}">
                                    <i class="fa "></i>
                                    <span>Add Board</span></a>
                            </li>
                            <li class="">
                                <a href="{{url('admin/boardList')}}">
                                    <i class="fa "></i>
                                    <span>List Board</span>
                                </a>
                            </li>
                        </ul>
                    </li>

            <li class="treeview"><a href="">
                    <i class="fa fa-users"></i>
                    <span>Subject</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li class="  ">
                        <a href="{{url('admin/schoolsubjectcreate')}}">
                            <i class="fa "></i>
                            <span>Add Subject</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('admin/subjectschoolList')}}">
                            <i class="fa "></i>
                            <span>List Subject</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview"><a href="">
                    <i class="fa fa-users"></i>
                    <span>Chapter</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li class="  ">
                        <a href="{{url('admin/schoolchaptercreate')}}">
                            <i class="fa "></i>
                            <span>Add Chapter</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('admin/schoolchapterList')}}">
                            <i class="fa "></i>
                            <span>List Chapter</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview"><a href="">
                    <i class="fa fa-users"></i>
                    <span>Chapter Content</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li class="  ">
                        <a href="{{url('admin/schoolchaptercontentcreate')}}">
                            <i class="fa "></i>
                            <span>Add Chapter Content</span></a>
                    </li>
                    <li class="">
                        <a href="{{url('admin/subjectschoolList')}}">
                            <i class="fa "></i>
                            <span>List Chapter Content</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section><!-- /.sidebar -->
</aside>