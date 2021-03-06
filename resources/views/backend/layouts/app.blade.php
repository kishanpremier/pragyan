<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" sizes="16x16" type="image/png" href="{{asset('img/ic_launcher.jpg')}}">
        {{--<title>@yield('title', app_name())</title>--}}

<!-- Meta -->
<meta name="description" content="@yield('meta_description', 'Default Description')">
<meta name="author" content="@yield('meta_author', 'Viral Solani')">
<link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css" rel="stylesheet">

@yield('meta')

<!-- Styles -->
@yield('before-styles')

<!-- Check if the language is set to RTL, so apply the RTL layouts -->
<!-- Otherwise apply the normal LTR layouts -->
@langrtl
{{ Html::style(getRtlCss('css/backend.css')) }}
@else
{{ Html::style('css/backend.css') }}
@endlangrtl

{{ Html::style('css/backend-custom.css') }}
@yield('after-styles')

<!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
{{ Html::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
{{ Html::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
<![endif]-->

<!-- Scripts -->
<script>
window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token() ]) !!}
;
            </script>

            <?php
            if (!empty($google_analytics)) {
                echo $google_analytics;
            }
            ?>
        </head>
        <body class="skin-{{ config('backend.theme') }} {{ config('backend.layout') }}">
            <div class="loading" style="display:none"></div>
            @include('includes.partials.logged-in-as')

            <div class="wrapper" id="app">
                @include('backend.includes.header')
                @include('backend.includes.sidebar-dynamic')

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">

                    </section>

                    <!-- Main content -->
                    <section class="content">
                        {{--@include('includes.partials.messages')--}}
                        @yield('content')
                    </section><!-- /.content -->
                </div><!-- /.content-wrapper -->

                @include('backend.includes.footer')
            </div><!-- ./wrapper -->

            <!-- JavaScripts -->
            @yield('before-scripts')

            
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
            {{ Html::script('js/backend.js') }}
            {{ Html::script('js/backend-custom.js') }}
            
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
            @yield('after-scripts')
        </body>



    </html>