<?php

namespace App\Http\Controllers\Backend\School;

use App\Models\Access\User\User;
use App\Models\School\videocount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //
    public function index() {
        
        $videoCount= [];

        $teacherList = User::where('users.user_type', '=', 1)
                ->get();

        foreach ($teacherList as $data) {

            $teacherListWithVideocount = videocount::where('video_count.user_id','=',$data->id)
                    ->get();
            array_push($videoCount, [$data->id => $teacherListWithVideocount]);
        
        }
        dd($videoCount);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
