<html>
</html><title>Chapter Content Listing</title>


@extends('backend.layouts.app')

@section('page-header')
<h1>
    Chapter Listing
    {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
</h1>
@endsection

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('history.backend.chaptercontentlisting') }}</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive data-table-wrapper">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Subject Name</th>
                        <th>Class Name</th>
                        <th>Chapter Name</th>
                        <th>Content Title</th>
                        <th>Content Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chapter as $k=> $chapter1)
                    <tr>
                        <td>{{$chapter1->id}}</td>
                        <td>{{$chapter1->subject_name}}</td>
                        <td>{{$chapter1->class_name}}</td>
                        <td>{{$chapter1->chapter_name}}</td>
                        <td>{{$chapter1->content_title}}</td>
                        <td>{{$chapter1->content_short_desc}}</td>
                        <td>
                            <a href="{{route('admin.schoolchaptercontent.edit',$chapter1->id)}}"><i class="fa fa-pencil schoolclass" aria-hidden="true"></i></a>
                            <a href="{{route('admin.schoolchaptercontent.delete',$chapter1->id)}}"><i class="fa fa-trash schoolclass" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Subject Name</th>
                            <th>Class Name</th>
                            <th>Chapter Name</th>
                            <th>Content Title</th>
                            <th>Content Description</th>
                            <th></th>
                        </tr>
                    </tfoot>
            </table>
        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">

    </div>
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
@section('after-scripts')
{{-- For DataTables --}}
{{ Html::script('js/dataTable.js') }}

<script>
$(document).ready(function() {
    $('#example').DataTable({
        initComplete: function () {
            this.api().columns([0,1,2,3,4,5]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'ChapterContent'
            }

        ]
    });
} );

</script>
@endsection
