<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\School\Chaptercontent;
use App\Models\School\ContentRating;
use App\Models\School\Chapter;
use App\Models\School\ContentCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterController extends Controller {

    public function getchapter($id) {

        $getChapter = Chapter::where('chapter.class_id', '=', $id)
                ->get();
        if ($getChapter != '') {
            $getChapterStatus = true;
        } else {
            $getChapterStatus = false;
        }
        return response()->json([
                    'status' => $getChapterStatus,
                    'data' => $getChapter]);
    }

    public function chapterContent(Request $request) {

        try {

            $request->validate([
                'content_title' => 'required',
                'content_type' => 'required',
                'content_short_desc' => 'required',
                'content_link' => 'required',
            ]);

            $Chaptercontent = new Chaptercontent();
            $Chaptercontent->chapter_id = $request['chapter_id'];
            $Chaptercontent->class_id = $request['class_id'];
            $Chaptercontent->subject_id = $request['subject_id'];
            $Chaptercontent->content_title = $request['content_title'];
            $Chaptercontent->content_type = $request['content_type'];
            $Chaptercontent->content_short_desc = $request['content_short_desc'];
            $Chaptercontent->content_link = $request['content_link'];

            $Chaptercontent->save();
            $message = 'Chapter content has been created';
        } catch (Exception $e) {

            $message = 'Something went wrong';
        }


        return response()->json([
                    'message' => $message]);
    }

    public function getchapterContent($id) {

        $chapterContent = Chaptercontent::where('chapter_content.chapter_id', '=', $id)
                ->get();

        if ($chapterContent != '') {
            $chapterContentStatus = true;
        } else {
            $chapterContentStatus = false;
        }

        return response()->json([
                    'status' => $chapterContentStatus,
                    'data' => $chapterContent,
                    'message' => 'School class']);
    }

    public function rating(Request $request) {

        try {

            $request->validate([
                'content_id' => 'required',
                'rating' => 'required',
            ]);

            $ContentRating = new ContentRating();
            $ContentRating->content_id = $request['content_id'];
            $ContentRating->rating = $request['rating'];

            $ContentRating->save();
            $message = 'Content rating has been created';
        } catch (Exception $e) {

            $message = 'Something went wrong';
        }

        return response()->json([
                    'message' => $message]);
    }

    public function getcontentcount(Request $request) {
        
        try {
            
             $request->validate([
                'content_id' => 'required',
                'user_id' => 'required',
                'view_time'=>'required'
            ]);

            $affectedRows = ContentCount::where('content_id', '=', $request['content_id'])
                ->where('user_id', '=', $request['user_id'])
                ->update([
                    'view_time' => $request['view_time'],
                ]);

            if($affectedRows == 0)
            {
                $ContentCount = new ContentCount();
                $ContentCount->content_id = $request['content_id'];
                $ContentCount->user_id = $request['user_id'];
                $ContentCount->view_time = $request['view_time'];
                $ContentCount->save();
                $message = 'Content count has been created';
            }
            else
                $message = 'Content count has been Updated';

        } catch (Exception $e) {

            $message = 'Something went wrong';
        }
          return response()->json([
                    'message' => $message]);
    }

}
