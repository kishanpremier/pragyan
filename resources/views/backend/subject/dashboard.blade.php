<html>

</html><title>Class Dashboard</title>


@extends('backend.layouts.app')

@section('page-header')
    <h1>
        Class DashBoard
        {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
    </h1>
@endsection

@section('content')
    @if(isset($status))
        @if($status != "Fail")
            <div class="alert alert-success">
                Class Added Successfully
            </div>
        @endif
    @endif
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.subject') }}</h3>
        </div><!-- /.box-header -->
        <form id="class_form"method="post" action="{{route('admin.subject.store')}}">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name:</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="class_name" id="name" placeholder="Enter Class Name....">
                    </div>
                </div>
                <p id="error_box">
                @if(isset($status))
                    @if($status == "Fail")
                        <div style="color:red;margin-left: 18px">
                            *{{$msg}}
                        </div>
                    @endif
                @endif
                <p>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <input type="submit" id="formbtn" class="btn btn-info pull-right" value="Add New Class">
            </div>
        </form>
    </div><!--box box-info-->
@endsection
@jquery
@toastr_js
@toastr_render
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</html>