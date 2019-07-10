<html>

</html><title>Class Listing</title>


@extends('backend.layouts.app')

@section('page-header')
    <h1>
        Class Listing
        {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.listing') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="pages-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <thead class="transparent-bg">
                    <tr>
                        <th>
                            {!! Form::text('first_name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => "Name"]) !!}
                            <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                        </th>
                        <th></th>
                    </tr>
                    </thead>
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
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</html>
@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}

    <script>

        $(function () {
            var dataTable1 = $('#pages-table').dataTable({
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                "destroy": true,
                "bFilter": false,
                "bInfo": false,
                "bLengthChange": false,
                "sScrollY": "30vh",
                "dom": "lfrti",
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                scrollY: 150,
                scroller: {
                    loadingIndicator: true,
                    "language": {
                        processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> '
                    },
                    serverWait: 300
                },
                "ajax": {
                    "url": "{{route('admin.subject.get')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        "_token": "{{ csrf_token() }}",
                    },
                },
                "fnInitComplete": function () {
                    $(window).trigger('resize');
                },
                "columns": [
                    {data: 'name', name: 'name'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
            });
            Backend.DataTableSearch.init(dataTable1);
        });
    </script>
@endsection
