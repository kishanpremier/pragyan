
<title>Create Banner</title>
@extends('backend.layouts.app')

@section('page-header')
<h1>
    Banner DashBoard
    {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
</h1>
@endsection

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('history.backend.banner') }}</h3>
    </div><!-- /.box-header -->
    <form id="school_chapter_form" name='banner_form' enctype="multipart/form-data" method="post" action="{{route('admin.banner.store')}}">
        @csrf

        @include('backend.pragyanbanner.form')
        
        <div class="box-footer">
            <div class="text-right">
                <input style="margin-right: 15px" type="submit" id="formbtn" class="btn btn-info" value="Add New Banner">
            </div>
        </div>
    </form>
</div><!--box box-info-->
@endsection

@jquery
@toastr_js
@toastr_render
@section('before-scripts')banner_image_other-error
    <script>
        function readURL(input) {
            var abc = $('#banner_image').val();
            var fileExtension = ['jpeg', 'jpg', 'png'];
            var abc1 = abc.split('.').pop().toLowerCase();

            if($.inArray(abc1,fileExtension) !== -1)
            {
                $('#banner_image-error').hide();
            }
        }
    </script>
<script>
    function readURLother(input) {
        var abc = $('#banner_image_other').val();
        var fileExtension = ['jpeg', 'jpg', 'png','docx','pdf','xlsx','csv'];
        var abc1 = abc.split('.').pop().toLowerCase();

        if($.inArray(abc1,fileExtension) !== -1)
        {
            $('#banner_image_other-error').hide();
        }
    }
</script>
    <script>
        $(document).ready(function()
        {
            $("#doctype").change(function()
            {
                if($(this).val() == 1 || $(this).val() == 3)
                {
                    $('#video_url_id').attr('style','display: none');
                    $('#banner_image_other_id').attr('style','display: show');
                }
                else if($(this).val() == 2)
                {
                    $("#banner_image_other_id").attr('style','display: none');
                    $('#video_url_id').attr('style','display: show');
                }
            });
        });
    </script>
    <script>
        $(function () {
            $("form[name='banner_form']").validate({
                rules: {
                    doctype: "required",
                    title: "required",
                    banner_image: {
                        required: true,
                        extension: "jpg|jpeg|png",
                        size: 500000
                    },
                    video_url: "required",
                    banner_image_other: {
                        required: true,
                        extension: "docx|xlsx|doc|pdf|jpg|jpeg|png|csv",
                        size: 500000
                    },
                },
                messages: {
                    doctype: "Please Select Document Type Here",
                    title: "Please Enter Banner Title Here",
                    banner_image: {
                        required: "Please Upload Proper Document",
                        extension: "Please Select From jpg|jpeg|png Format",
                        size: "Please Select File Less Than 5MB Size"
                    },
                    video_url: "Please Enter Video Url Here",
                    banner_image_other: {
                        required: "Please Upload Proper Document",
                        extension: "Please Select From docx|xlsx|doc|pdf|jpg|jpeg|png|csv Format",
                        size: "Please Select File Less Than 5MB Size"
                    },
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@stop
