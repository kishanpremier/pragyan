@extends('backend.layouts.app')

@section('page-header')
<h1>
    Subject DashBoard
    {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
</h1>
@endsection

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('history.backend.editsubject') }}</h3>
    </div><!-- /.box-header -->
    <form id="class_form" name="school_subject_form" enctype="multipart/form-data" method="post" action="{{route('admin.subjectschool.store')}}">
        @csrf
         @include('backend.subject1.form')
        <div class="box-footer">
            <div class="text-right">
            <input style="margin-right: 15px" type="submit" id="formbtn" class="btn btn-info" value="Update Class">
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgsubject')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(function () {

        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        $("form[name='school_subject_form']").validate({

            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                subject_name: "required"

            },
            // Specify validation error messages
            messages: {
                subject_name: "Please enter your subject name"

            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
@stop