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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#class_form').submit(function (e) {
            var class_name = $('#class_name').val();
            if(class_name === ""){
                $('<strong style="color: red">*The class name field is required.</strong>').appendTo('#invalid-feedback #error');
                e.preventDefault();
            }
            $("#class_form").validate({
                rules: {
                    class_name: "required",
                },
                messages: {
                    class_name: "*The class name field is required.",
                },
            });
        });
    });
    </script>
@stop
