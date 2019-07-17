@extends('backend.layouts.app')

@section('page-header')
    <h1>
        SchoolBoard DashBoard
        {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
    </h1>
@endsection

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.edit') }}</h3>
        </div><!-- /.box-header -->
        <form id="board_form" name="school_board_form" method="post" action="{{route('admin.schoolboard.store')}}">
            @csrf
            @include('backend.schoolboard.form')
            <div class="box-footer">
                <div class="text-right">
                    <input style="margin-right: 15px" type="submit" id="formbtn" class="btn btn-info" value="Add New StateBoard">
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
            $("form[name='school_board_form']").validate({

                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    state_board_name: "required"

                },
                // Specify validation error messages
                messages: {
                    state_board_name: "Please enter State Board name"

                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@stop