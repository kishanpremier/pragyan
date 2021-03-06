<title>DashBoard</title>
@extends('backend.layouts.app')

@section('page-header')
    <h1>
        {{ app_name() }}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Dashboard</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <a href="{{route('admin.teacher.list')}}">
                <div class="col-md-2 bg-primary">
                    <p>
                        <center><h3><b>Teacher</b></h3></center>
                    </p>
                    <p>
                        <center><h3>{{$getTecharUserCount}}</h3></center>
                    </p>
                </div>
            </a>
            <a href="{{route('admin.parent.list')}}">
                <div class="col-md-2 bg-primary">
                    <p>
                    <center><h3><b>Parent</b></h3></center>
                    </p>
                    <p>
                    <center><h3>{{$getparentUserCount}}</h3></center>
                    </p>
                </div>
            </a>
            <div class="col-md-2 bg-primary">
               <p><center><h3><b>Content count</b></h3></center></p>
            <p><center><h3>{{$getvideocount}}</h3></center></p>
            </div>
             
            
            
            
        </div><!-- /.box-body -->
    </div><!--box box-info-->
@endsection