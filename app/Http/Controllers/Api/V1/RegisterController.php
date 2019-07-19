<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\School\School;
use App\Models\School\Schoolboard;
use App\Models\School\Schoolclass;
use App\Models\School\Subject;
use Illuminate\Support\Facades\Hash;
use App\Models\Access\User\User;
use App\Repositories\Frontend\Access\User\UserRepository;
use Config;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends APIController {

    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Register User.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validation = Validator::make($request->all(), [
                    'user_type' => 'required',
                    'age' => 'required',
                    'gender' => 'required',
                    'mobile' => 'required',
                    'state' => 'required',
                    'district' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:4',
                    'password_confirmation' => 'required|same:password',
                    'is_term_accept' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $user = $this->repository->create($request->all());

        if (!Config::get('api.register.release_token')) {
            return $this->respondCreated([
                        'message' => trans('api.messages.registeration.success'),
            ]);
        }

        $passportToken = $user->createToken('API Access Token');

        // Save generated token
        $passportToken->token->save();

        $token = $passportToken->accessToken;

        return $this->respondCreated([
                    'message' => trans('api.messages.registeration.success'),
                    'token' => $token,
        ]);
    }

    public function edit($id) {

        $userEdit = User::find($id);

        return response()->json([
                    'message' => 'get user information',
                    'data' => $userEdit,
        ]);
    }

    public function update(Request $request, $id) {
        
        
        try {

            $request->validate([
                'user_type' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'mobile' => 'required',
                'state' => 'required',
                'district' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4',
                'password_confirmation' => 'required|same:password',
                
            ]);

            $userUpdate = User::findOrFail($id);

            $userUpdate->first_name = $data['first_name'];
            $userUpdate->last_name = $data['last_name'];
            $userUpdate->email = $data['email'];
            $userUpdate->user_type = $data['user_type'];
            $userUpdate->age = $data['age'];
            $userUpdate->gender = $data['gender'];
            $userUpdate->mobile = $data['mobile'];
            $userUpdate->state = $data['state'];
            $userUpdate->district = $data['district'];
            $userUpdate->classes = $data['classes'];
            $userUpdate->subject = $data['subject'];
            $userUpdate->schoolcode = $data['schoolcode'];
            $userUpdate->school_name = $data['school_name'];
            $userUpdate->state_board = $data['state_board'];

            $userUpdate->confirmation_code = md5(uniqid(mt_rand(), true));
            $userUpdate->status = 1;
            $userUpdate->password = $provider ? null : bcrypt($data['password']);
            $userUpdate->is_term_accept = $data['is_term_accept'];

            $userUpdate->save();

            $message = 'user has been updated';
        } catch (Exception $e) {

            $message = 'Something went wrong';
        }
        return $this->respondCreated([
                    'message' => $message,
        ]);
    }
    
    public function updateAuthUserPassword(Request $request,$id)
    {
   
        $this->validate($request, [
            'current' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::find($id);

        if (!Hash::check($request->current, $user->password)) {
            return response()->json(['current'=> ['Current password does not match']], 422);
        }
        
        $user->password = bcrypt($request->password);
        
        $user->save();

        return response()->json(['message' => 'password change successfully']);
    }

    public function stateBoard() {

        $Schoolboard = Schoolboard::get();

        if ($Schoolboard != '') {
            $schoolStatus = true;
        } else {
            $schoolStatus = false;
        }

        return response()->json([
                    'status' => $schoolStatus,
                    'data' => $Schoolboard,
                    'message' => 'State Board']);
    }

    public function school() {

        $School = School::get();
        if ($School != '') {
            $schoolStatusAc = true;
        } else {
            $schoolStatusAc = false;
        }

        return response()->json([
                    'status' => $schoolStatusAc,
                    'data' => $School,
                    'message' => 'school']);
    }

    public function schoolClass($id) {

        $Schoolclass = Schoolclass::where('class.subject_id', '=', $id)
                ->get();

        if ($Schoolclass != '') {
            $SchoolclassStatus = true;
        } else {
            $SchoolclassStatus = false;
        }

        return response()->json([
                    'status' => $SchoolclassStatus,
                    'data' => $Schoolclass,
                    'message' => 'School class']);
    }
    
     public function getschoolClass() {

        $Schoolclass = Schoolclass::get();

        if ($Schoolclass != '') {
            $SchoolclassStatus = true;
        } else {
            $SchoolclassStatus = false;
        }

        return response()->json([
                    'status' => $SchoolclassStatus,
                    'data' => $Schoolclass,
                    'message' => 'School class']);
    }
    

    public function subject() {

        $subject = Subject::get();

        if ($subject != '') {
            $subjectStatus = true;
        } else {
            $subjectStatus = false;
        }

        return response()->json([
                    'status' => $subjectStatus,
                    'data' => $subject,
                    'message' => 'Subject']);
    }

}
