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
    <form id="class_form" name="school_class_form" method="post" action="{{route('admin.class.store')}}">
        @csrf
       
        @include('backend.subject.form')
        
        <div class="box-footer">
            <div class="text-right">
                <input style="margin-right: 15px" type="submit" id="formbtn" class="btn btn-info" value="Add New Class">
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
        $(function () {

            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("form[name='school_class_form']").validate({

                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    class_name: "required"

                },
                // Specify validation error messages
                messages: {
                    class_name: "Please enter Class Name Here"

                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@stop
