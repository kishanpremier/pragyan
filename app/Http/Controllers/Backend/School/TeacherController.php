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
      
        $videoCount = User::leftJoin('video_count', 'video_count.user_id', '=', 'users.id')
                ->leftJoin('chapter_content', 'chapter_content.id', '=', 'video_count.chapter_content_id')
                ->where('users.user_type', '=', 1)
                ->select([
                        'users.id',
                        'users.first_name',
                        'users.last_name',
                        'video_count.count',
                        'chapter_content.content_title',
                        'chapter_content.content_link'
                    ])
                ->groupBy('users.id')
                ->get();
        
        return view('backend.teacher.index')->with(compact('videoCount'));
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
    public function history($id)
    {
        $obj = videocount::where('user_id',$id)
            ->leftjoin('chapter_content','chapter_content.id','=','video_count.chapter_content_id')
            ->leftjoin('class','class.id','=','chapter_content.class_id')
            ->leftjoin('subject','subject.id','=','chapter_content.subject_id')
            ->leftjoin('users','users.id','=','video_count.user_id')
            ->select([
                'users.first_name',
                'users.last_name',
                'class.class_name',
                'subject.subject_name',
                'chapter_content.content_title',
                'video_count.view_time',
                'video_count.count',
                'chapter_content.content_link'
            ])
            ->get();
        return view('backend.teacher.history')->with(compact('obj'));
    }

}
