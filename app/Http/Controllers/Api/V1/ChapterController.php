<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\School\Chaptercontent;

use App\Models\School\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterController extends Controller {

    public function getchapter($id) {
        
       $getChapter = Chapter::where('chapter.class_id','=',$id)
               ->get();

        return response()->json([
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
    

}
