<html>
</html><title>Chapter Listing</title>


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
        <h3 class="box-title">{{ trans('history.backend.chapterlisting') }}</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive data-table-wrapper">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Document Type</th>
                        <th>Video Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bannerdata as $k=> $bannerdata1)
                    <tr>
                        <td>{{$bannerdata1->id}}</td>
                        <td>@if($bannerdata1->doc_type == 1 || $bannerdata1->doc_type == 3) File @else Video @endif</td>
                        <td>{{$bannerdata1->video_link}}</td>
                        <td>
                            <a href="{{route('admin.banner.edit',$bannerdata1->id)}}"><i class="fa fa-pencil schoolclass" aria-hidden="true"></i></a>
                            <a href="{{route('admin.banner.delete',$bannerdata1->id)}}"><i class="fa fa-trash schoolclass" aria-hidden="true"></i></a>
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
    $('#example').DataTable();
} );

</script>
@endsection
