
<title>Chapter Dashboard</title>
@extends('backend.layouts.app')

@section('page-header')
<h1>
    Chapter DashBoard
    {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
</h1>
@endsection

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('history.backend.chapter') }}</h3>
    </div><!-- /.box-header -->
    <form id="school_subject_form" enctype="multipart/form-data" method="post" action="{{route('admin.schoolchapter.store')}}">
        @csrf

        @include('backend.chapter.form')
        
        <div class="box-footer">
            <input type="submit" id="formbtn" class="btn btn-info pull-right" value="Add New Subject">
        </div>
    </form>
</div><!--box box-info-->
@endsection

@jquery
@toastr_js
@toastr_render
@section('before-scripts')


<script>
    $(document).ready(function() {
        $('#subject').change(function () {

            $.ajax({
                dataType: "json",
                type: "POST",
                url: "{{route('admin.dynamic.fetch')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "value": $('#subject option:selected').val()
                },
                success: function (data) {
                    $('#class').html(data);
                }
            });
        });
    });
</script>
@stop
