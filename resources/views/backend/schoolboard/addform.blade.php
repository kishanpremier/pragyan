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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {

            $('#board_Form').validate({ // initialize the plugin
                rules: {
                    state_board_name: {
                        required: true
                    },

                }
            });
        });
    </script>

@stop
