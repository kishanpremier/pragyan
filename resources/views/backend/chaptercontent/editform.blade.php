<title>Edit Chapter Content</title>
@extends('backend.layouts.app')

@section('page-header')
<h1>
    {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
</h1>
@endsection

@section('content')

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('history.backend.chaptercontentedit') }}</h3>
    </div><!-- /.box-header -->
    <form id="class_form" name="chapter_content_form" enctype="multipart/form-data" method="post" action="{{route('admin.schoolchaptercontent.store')}}">
        @csrf
         @include('backend.chaptercontent.form')
        <div class="box-footer">
            <div class="text-right">
                <input style="margin-right: 15px" type="submit" id="formbtn" class="btn btn-info" value="Update Chapter Content">
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
            $("form[name='chapter_content_form']").validate({
                rules: {
                    class_name: "required",
                    subject_name: "required",
                    chapter_name: "required",
                    content_title: "required",
                    content_type: {
                        required: false,
                        extension: "docx|xlsx|doc|pdf|jpg|jpeg|png|csv|eps|emf|wmf|bmp|gif|tiff",
                        size: 500000
                    },
                    video_link: {
                        url:true,
                        required: function(){
                            return $("#content_type").is(':empty');
                        }
                    },
                    content_description: "required"
                },
                messages: {
                    class_name: "Please Select Class Name Here",
                    subject_name: "Please Select Subject Name Here",
                    chapter_name: "Please Select Chapter Name Here",
                    content_title: "PLease Enter Content Title Here",
                    content_type: {
                        required: "Please Upload Proper Document",
                        extension: "Please Select From docx|xlsx|doc|pdf|jpg|jpeg|png|csv Format",
                        size: "Please Select File Less Than 5MB Size"
                    },
                    video_link: {
                        url: "This Is Not A Youtube Video Link",
                        required: "Please Enter Proper Video Link"
                    },
                    content_description: "Please Enter Proper Description"
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#subject_name').change(function () {
                $('#class_name').val('');
                $('#chapter_name').val('');

                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: "{{route('admin.dynamicclass.fetch')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "value": $('#subject_name option:selected').val()
                    },
                    success: function (data) {
                        $('#class_name').html(data);
                    }
                });
            });
            $('#class_name').change(function() {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: "{{route('admin.dynamicchapter.fetch')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "value1": $('#subject_name option:selected').val(),
                        "value": $('#class_name option:selected').val()
                    },
                    success: function(data)
                    {
                        $('#chapter_name').html(data);
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