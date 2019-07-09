<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\School\School;
use App\Models\School\Schoolboard;
use App\Models\School\Schoolclass;
use App\Repositories\Frontend\Access\User\UserRepository;
use Config;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Register User.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_type'            => 'required',
            'age'            => 'required',
            'gender'            => 'required',
            'mobile'            => 'required',
            'state'            => 'required',
            'district'            => 'required',
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:4',
            'password_confirmation' => 'required|same:password',
            'is_term_accept'        => 'required',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $user = $this->repository->create($request->all());

        if (!Config::get('api.register.release_token')) {
            return $this->respondCreated([
                'message'  => trans('api.messages.registeration.success'),
            ]);
        }

        $passportToken = $user->createToken('API Access Token');

        // Save generated token
        $passportToken->token->save();

        $token = $passportToken->accessToken;

        return $this->respondCreated([
            'message'   => trans('api.messages.registeration.success'),
            'token'     => $token,
        ]);
    }
    
    public function stateBoard(){
        
        $Schoolboard = Schoolboard::get();
        return response($Schoolboard);
        
    }
    
     public function school(){
        
        $School = School::get();
        return response($School);
        
    }
    
     public function schoolClass(){
        
        $Schoolclass = Schoolclass::get();
        return response($Schoolclass);
        
    }
}
