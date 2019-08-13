<html>

</html>
@foreach($obj as $username)
    <title>{{$username->first_name}} {{$username->last_name}} - History</title>
    @break
@endforeach


@extends('backend.layouts.app')

@section('page-header')
    <h1>
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            @foreach($obj as $username)
                <h3 class="box-title">
                    Parent Name:- <span id="name">{{$username->first_name}} {{$username->last_name}}</span>
                </h3>
                @break
            @endforeach
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Content Title</th>
                        <th>Class Name</th>
                        <th>Subject Name</th>
                        <th>Chapter Name</th>
                        {{--<th>Content Link</th>--}}
                        <th>Count</th>
                        <th>View Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;?>
                    @foreach($obj as $data)
                        <tr>
                            <td>
                                <?php $i++;?>
                                {{$i}}
                            </td>
                            <td>{{$data->content_title}}</td>
                            <td>{{$data->class_name}}</td>
                            <td>{{$data->subject_name}}</td>
                            <td>{{$data->chapter_name}}</td>
                            {{--<td>{{$data->content_link}}</td>--}}
                            <td>{{$data->count}}</td>
                            <td>
                                @if($data->view_time == "null")
                                    <p></p>
                                @else
                                    {{$data->view_time}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
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
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: $('#name').text(),
                    }
                ]
            } );
        } );

    </script>
@endsection
