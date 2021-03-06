<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Access\Permission\Permission;
use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use App\Models\School\videocount;
use App\Models\Settings\Setting;
use Illuminate\Http\Request;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        $getTecharUserCount = User::where('users.user_type','=','1')
                ->count();
        $getparentUserCount = User::where('users.user_type','=','0')
                ->count();
        
        $getvideocount1 = videocount::sum('count');
        $getvideocount = (int)$getvideocount1;
        
        $settingData = Setting::first();
        $google_analytics = $settingData->google_analytics;

        return view('backend.dashboard', compact('google_analytics', $google_analytics,'getTecharUserCount','getparentUserCount','getvideocount'));
    }

    /**
     * Used to display form for edit profile.
     *
     * @return view
     */
    public function editProfile(Request $request)
    {
        return view('backend.access.users.profile-edit')
            ->withLoggedInUser(access()->user());
    }

    /**
     * Used to update profile.
     *
     * @return view
     */
    public function updateProfile(Request $request)
    {
        $input = $request->all();
        $userId = access()->user()->id;
        $user = User::find($userId);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->updated_by = access()->user()->id;

        if ($user->save()) {
            return redirect()->route('admin.profile.edit')
                ->withFlashSuccess(trans('labels.backend.profile_updated'));
        }
    }

    /**
     * This function is used to get permissions details by role.
     *
     * @param Request $request
     */
    public function getPermissionByRole(Request $request)
    {
        if ($request->ajax()) {
            $role_id = $request->get('role_id');
            $rsRolePermissions = Role::where('id', $role_id)->first();
            $rolePermissions = $rsRolePermissions->permissions->pluck('display_name', 'id')->all();
            $permissions = Permission::pluck('display_name', 'id')->all();
            ksort($rolePermissions);
            ksort($permissions);
            $results['permissions'] = $permissions;
            $results['rolePermissions'] = $rolePermissions;
            $results['allPermissions'] = $rsRolePermissions->all;
            echo json_encode($results);
            die;
        }
    }
    public function users()
    {
        $user = User::where('user_type','!=',2)->get();
        foreach ($user as $data) {
            if($data->login_time != null && $data->login_time != "null"){
                $data->login_time = date("Y-m-d g:i:s", strtotime($data->login_time));
            }
        }
        return view('backend.user.index', compact('user'));
    }
}
