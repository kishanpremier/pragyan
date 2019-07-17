<title>SchoolBoard Dashboard</title>
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
            <h3 class="box-title">{{ trans('history.backend.schoolboard') }}</h3>
        </div><!-- /.box-header -->
        <form id="board_form" method="post" action="{{route('admin.schoolboard.store')}}">
            @csrf

            @include('backend.schoolboard.form')

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

    <script src="http://127.0.0.1:8000/js/jquery.validate.js">
        $().ready(function() {
            // validate the comment form when it is submitted
            $("#board_form").validate();
        });

        $(document).ready(function () {
            $('#board_form').validate({ // initialize the plugin
                rules: {
                    state_board_name: {
                        required: true
                    },
                }
            });
        });

        $('#board_form').bootstrapValidator({
            fields: {
                "checklist_name": {
                    validators: {
                        notEmpty: {
                            message: 'The checklist name is required'
                        }
                    }
                }
            }

        });
    </script>
@stop
