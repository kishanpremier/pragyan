<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends APIController {

    /**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {

        $validation = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required|min:4',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $credentials = $request->only(['email', 'password']);
        
        try {
            if (!Auth::attempt($credentials)) {

                    return response()->json([
                            'message' => trans('api.messages.login.failed'),
                            'status_code' => 422,
                ]);
            }
            $user = $request->user();
            
            if($user->user_type == 1 || $user->user_type == 0){
            $passportToken = $user->createToken('API Access Token');

            // Save generated token
            $passportToken->token->save();
            $token = $passportToken->accessToken;
            }else{
                $token = '';
            }
            
            
        } catch (\Exception $e) {

            return $this->respondInternalError($e->getMessage());
        }
        if ($token != '') {
            $message = trans('api.messages.login.success');
            $loginStatus = true;
        } else {
            
            $message = trans('api.messages.login.failed');
            $loginStatus = false;
        }
        return response()->json([
                    'status' => $loginStatus,
                    'user'=> $user,
                    'message' => $message,
                    'token' => $token,
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        try {
            $request->user()->token()->revoke();
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }

        return $this->respond([
                    'message' => trans('api.messages.logout.success'),
        ]);
    }

}
