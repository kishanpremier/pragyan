<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\School\Chaptercontent;

use App\Models\School\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterController extends Controller {

    public function chapter(Request $request) {

        try {

            $request->validate([
                'chapter_name' => 'required',
            ]);

            $Chapter = new Chapter();

            $Chapter->class_id = $request['class_id'];
            $Chapter->subject_id = $request['subject_id'];
            $Chapter->chapter_name = $request['chapter_name'];

            $Chapter->save();
            $message = 'chapter has been created';
        } catch (Exception $e) {

            $message = 'Something went wrong';
        }

        return response($message);
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

        return response($message);
    }

}
