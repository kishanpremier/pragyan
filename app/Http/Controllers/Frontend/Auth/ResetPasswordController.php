<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Access\User\UserRepository;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ChangePasswordController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Where to redirect users after resetting password.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('frontend.index');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param string|null $token
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm($token = null)
    {
        if (!$token) {
            return redirect()->route('frontend.auth.password.email');
        }

        $user = $this->user->findByPasswordResetToken($token);

        if ($user && app()->make('auth.password.broker')->tokenExists($user, $token)) {
            return view('frontend.auth.passwords.reset')
                ->withToken($token)
                ->withEmail($user->email);
        }

        return redirect()->route('frontend.auth.password.email')
            ->withFlashDanger(trans('exceptions.frontend.auth.password.reset_problem'));
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"',
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'password.regex' => 'Password must contain at least 1 uppercase letter and 1 number.',
        ];
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $response
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetResponse($request, $response)
    {
        $obj = User::where('email',$request->email)->get();
        if($obj[0]->user_type != 2){
            $password = $request->password;
            return  view('emails.changed-password')->with(compact('password'));
        }
        return redirect()->route(homeRoute())->withFlashSuccess(trans($response));
    }
}
