@extends('backend.layouts.app')

@section('page-header')
<h1>
    Class DashBoard
    {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
</h1>
@endsection

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('history.backend.subject') }}</h3>
    </div><!-- /.box-header -->
    <form id="class_form" method="post" action="{{route('admin.class.store')}}">
        @csrf
         @include('backend.subject.form')
        <div class="box-footer">
            <input type="submit" id="formbtn" class="btn btn-info pull-right" value="Add New Class">
        </div>
    </form>
</div><!--box box-info-->
@endsection

@jquery
@toastr_js
@toastr_render
@section('before-scripts')
<script>
    $("#class_form").validate();
</script>
@stop