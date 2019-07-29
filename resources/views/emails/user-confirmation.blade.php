@extends('emails.layouts.app')

@section('content')
<div class="content">
    <div>
        Hello!<br>
        Click here to confirm your account:
    </div>

    <a href="{{ $confirmation_url }}" style="text-decoration: none;">
        <div align="center" style="background-color: blue;
        width: 300px;
        padding: 20px;
        margin: 2px;
        text-align:center;
        color:white;
        font-weight:bold;
        font-size:25px;">
            Click HERE
        </div>
    </a>
    Thank you for using our application!
    @yield('title', app_name())
    {{--<td>
        <table border="0" width="80%" align="center" cellpadding="0" cellspacing="0" class="container590">
            <tr>
                <td align="left" style="color: #888888; width:20px; font-size: 16px; line-height: 24px;">
                    <!-- section text ======-->

                    <p --}}{{--style="line-height: 24px; margin-bottom:15px;"--}}{{-->
                        Hello!
                    </p>
                    
                    <p --}}{{--style="line-height: 24px; margin-bottom:20px;"--}}{{-->
                        Click here to confirm your account:
                    </p>
                    <table border="0" align="center" width="180" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="margin-bottom:20px; background: #003bd7; border-radius: 5px;">

                        <tr>
                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                        </tr>

                        <tr>
                            <td align="center" style="color: #ffffff; font-size: 14px; line-height: 22px;letter-spacing: 1px;font-weight: bold;">
                                <a href="{{ $confirmation_url }}" style="color: #ffffff; text-decoration: none;">
                                    <div style="line-height: 22px;">
                                        Click HERE
                                    </div>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                        </tr>

                    </table>

                    <p style="line-height: 24px; margin-bottom:20px;">
                        Thank you for using our application!
                    </p>

                    <p style="line-height: 24px">
                        Regards,</br>
                        @yield('title', app_name())
                    </p>

                    <br/>

                    <p class="small" style="line-height: 24px; margin-bottom:20px;">
                            --}}{{--If you’re having trouble clicking the "Confirm Account" button, copy and paste the URL below into your web browser:--}}{{--
                    </p>


                    @include('emails.layouts.footer')
                </td>
            </tr>
        </table>
    </td>--}}
</div>
@endsection
                        