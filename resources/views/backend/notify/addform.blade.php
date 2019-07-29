<title>Create Notification</title>
@toastr_css
@extends('backend.layouts.app')

@section('page-header')
    <h1>
        Notification DashBoard
        {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
    </h1>
@endsection

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.notification') }}</h3>
        </div><!-- /.box-header -->
        <form id="board_form" enctype="multipart/form-data" name="notify_form" method="post" action="{{route('admin.notify.store')}}">
            @csrf

            @include('backend.notify.form')

            <div class="box-footer">
                <div class="text-right">
                    <input style="margin-right: 15px" type="submit" id="formbtn" class="btn btn-info" value="Add New Notification">
                </div>
            </div>
        </form>
    </div><!--box box-info-->
@endsection
@jquery
@toastr_js
@toastr_render
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js" integrity="sha256-xLhce0FUawd11QSwrvXSwST0oHhOolNoH9cUXAcsIAg=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</html>
@section('before-scripts')
    <script>
        function validate(input) {
            var abc = $('#notify_image').val();
            var fileExtension = ['jpeg', 'jpg', 'png'];
            var abc1 = abc.split('.').pop().toLowerCase();

            if($.inArray(abc1,fileExtension) !== -1)
            {
                $('#notify_image-error').hide();
            }
        }
    </script>
    <script>
        $(function () {
            $("form[name='notify_form']").validate({
                rules: {
                    title: "required",
                    notify_description: "required",
                    notify_image: {
                        required: false,
                        extension: "jpg|jpeg|png",
                        /*size: 2048,*/

                    },
                },
                messages: {
                    title: "Please enter Title Here",
                    notify_description: "Please Enter Notification Here",
                    notify_image:{
                        extension: "Please Select From jpg|jpeg|png Format",
                        /*size: "PLease Select File Upto 2MB",*/
                    },
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@stop
