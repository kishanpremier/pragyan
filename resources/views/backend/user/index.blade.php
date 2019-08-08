<html>

</html><title>Users Listing</title>


@extends('backend.layouts.app')

@section('page-header')
<h1>
    Board Listing
    {{--<small>{{ trans('strings.backend.dashboard.classdashboard') }}</small>--}}
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.user') }}</h3>
        </div><!-- /.box-header     -->
        <div class="box-bod        y">
            <div class="table-responsive data-table-wrapper">
    <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>District</th>
                            <th>State</th>
                            <th>School Name</th>
                            <th>State Board</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>User-Type</th>
                            <th>Status</th>
                            <th>Last Login Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0;?>
                        @foreach($user as $k=> $SchoolBoardData)
                        <tr>
                            <td>
                                <?php $i++;?>
                                {{$i}}
                            </td>
                            <td>{{$SchoolBoardData->first_name}} {{$SchoolBoardData->last_name}}</td>
                            <td>{{$SchoolBoardData->email}}</td>
                            <th>{{$SchoolBoardData->mobile}}</th>
                            <th>{{$SchoolBoardData->district}}</th>
                            <th>{{$SchoolBoardData->state}}</th>
                            <th>{{$SchoolBoardData->school_name}}</th>
                            <th>{{$SchoolBoardData->state_board}}</th>
                            <td>{{$SchoolBoardData->age}}</td>
                            <td>
                                @if($SchoolBoardData->gender)
                                    Male
                                @else
                                    Female
                                @endif
                            </td>
                            <td>
                                @if($SchoolBoardData->user_type)
                                    Teacher
                                @else
                                    Parent
                                @endif
                            </td>
                            <td>
                                @if($SchoolBoardData->status)
                                    Active
                                @else
                                    InActive
                                @endif
                            </td>
                            <td>
                                @if($SchoolBoardData->login_time == "null")
                                    <p></p>
                                @else
                                    {{$SchoolBoardData->login_time}}
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

$(document).ready(function () {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'State Board'
            }

        ]
    });
});

</script>
@endsection
