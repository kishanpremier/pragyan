<?php

namespace App\Http\Controllers\Backend\School;

use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\School\videocount;
use App\Http\Controllers\Controller;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$videoCount= [];

        //$parentList = User::where('users.user_type', '=', 0)
          //  ->get();

         $videoCount = User::leftJoin('video_count', 'video_count.user_id', '=', 'users.id')
                ->leftJoin('chapter_content', 'chapter_content.id', '=', 'video_count.chapter_content_id')
                ->where('users.user_type', '=', 0)
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
//        foreach ($parentList as $data) {
//            $parentListWithVideocount = videocount::where('video_count.user_id','=',$data->id)
//                ->leftJoin('chapter_content','chapter_content.id','=','video_count.chapter_content_id')
//                ->leftJoin('users','users.id','=','video_count.user_id')
//                ->get();
//            array_push($videoCount, [$data->id => $parentListWithVideocount]);
//        }

        return view('backend.parent.index')->with(compact('videoCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
