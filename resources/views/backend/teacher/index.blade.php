<html>

</html><title>Video Count Listing</title>


@extends('backend.layouts.app')

@section('page-header')
    <h1>
        Video Count Listing
        {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.videocount') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Teacher Name</th>
                        <th>Video Link</th>
                        <th>Video Count</th>

                    </tr>
                    </thead>
                    <tbody>

                    @forelse($videoCount as $k=> $val)
                        @forelse($val as $l=> $val1)
                            @forelse($val1 as $j=> $val2)
                        <tr>
                            <td>
                                {{$val2->id}}
                            </td>
                            <td>
                                {{$val2->first_name}} {{$val2->last_name}}
                            </td>
                            <td>
                                {{$val2->content_link}}
                            </td>
                            <td>
                                {{$val2->content_title}} ({{$val2->count}})
                            </td>
                        </tr>
                    @empty
                    @endforelse
                        @empty
                        @endforelse
                    @empty
                    @endforelse


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
