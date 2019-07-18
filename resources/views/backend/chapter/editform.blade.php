<title>Edit Chapter</title>
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
        <h3 class="box-title">{{ trans('history.backend.editchapter') }}</h3>
    </div><!-- /.box-header -->
    <form id="class_form" name="school_chapter_form" method="post" action="{{route('admin.schoolchapter.store')}}">
        @csrf
         @include('backend.chapter.form')
        <div class="box-footer">
            <div class="text-right">
                <input style="margin-right: 15px" type="submit" id="formbtn" class="btn btn-info" value="Update Chapter">
            </div>
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
    <script>
        $(function () {

            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("form[name='school_chapter_form']").validate({

                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    class_name: "required",
                    subject_name: "required",
                    chapter_name: "required",

                },
                // Specify validation error messages
                messages: {
                    class_name: "Please Select Class Name Here",
                    subject_name: "Please Select Subject Name Here",
                    chapter_name: "Please Enter Chapter Name Here"
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@stop