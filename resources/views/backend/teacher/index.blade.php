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
                        <th>Content Link</th>
                        <th>Content Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;?>
                    @forelse($videoCount as $k=> $val)
                        @forelse($val as $l=> $val1)
                        <?php $dataCount = count($val1); ?>
                        @if($dataCount > 1)
                            @forelse($val1 as $j=> $val2)
                                <tr>
                                    <td>
                                        <?php $i++;?>
                                        {{$i}}
                                    </td>
                                    <td>
                                        {{$val2->first_name}} {{$val2->last_name}}
                                    </td>
                                    <td>
                                        {{$val2->content_link}}
                                    </td>
                                    <td>
                                       <select>
                                            @foreach($val1 as $drop)
                                              @if(isset($drop->content_title))
                                                <option>{{$drop->content_title}} ({{$drop->count}})</option>
                                              @endif  
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @break
                            @empty
                            @endforelse
                        @endif
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
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );

    </script>
@endsection
