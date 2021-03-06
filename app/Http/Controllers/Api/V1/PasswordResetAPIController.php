<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\Access\User\User;
use App\Models\Access\PasswordReset\PasswordReset;


class PasswordResetAPIController extends Controller
{
     /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60)
             ]
        );
        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();

        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        /*return response()->json($passwordReset);*/
        return view('frontend.auth.passwords.apireset')->with(
            ['token' => $passwordReset->token, 'email' => $passwordReset->email]
        );
    }

    public function showResetForm(Request $request, $token = null)
    {

    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);
        $user->password = $request->password;
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));

        return  view('emails.changed-password');

        /*if($user != ''){
            $status = true;
        }else{
            $status = false;
        }
        return response()->json([
                'status' => $status,
                'message' => $user
        ], 404);*/

        /*$obj = User::where('email',$request->email)->get();
        if($obj[0]->user_type != 2){
            $password = $request->password;
            return  view('emails.changed-password')->with(compact('password'));
        }
        return redirect()->route(homeRoute())->withFlashSuccess(trans($response));*/
        
    }
}
