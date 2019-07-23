<?php

namespace App\Http\Controllers\Backend\ChapterContent;

use App\Models\School\Chapter;
use App\Models\School\Chaptercontent;
use App\Models\School\Schoolclass;
use App\Models\School\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapter = Chaptercontent::query()
            ->leftjoin('subject', 'subject.id', '=', 'chapter_content.subject_id')
            ->leftJoin('class','class.id','=','chapter_content.class_id')
            ->leftJoin('chapter','chapter.id','=','chapter_content.chapter_id')
            ->select([
                'subject.subject_name',
                'chapter.chapter_name',
                'class.class_name',
                'chapter_content.id',
                'chapter_content.content_title',
                'chapter_content.content_short_desc'
            ])
            ->get();
        return view('backend.chaptercontent.index', compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = Subject::get();
        //$val1 = Schoolclass::get();
        return view('backend.chaptercontent.addform')->with(compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if($request->id == ''){
                $request->validate([
                    'subject_name' => 'required|integer',
                    'class_name' => 'required|integer',
                    'chapter_name' => 'required|integer',
                    'content_title' => 'required',
                    'content_type' => 'required',
                    'video_link' => 'required|url',
                    'content_description' => 'required'
                ]);
            }
            else{
                $request->validate([
                    'subject_name' => 'required|integer',
                    'class_name' => 'required|integer',
                    'chapter_name' => 'required|integer',
                    'content_title' => 'required',
                    'video_link' => 'required|url',
                    'content_description' => 'required'
                ]);
            }

            /*$validate = preg_match('/^(https|http):\/\/(?:www\.)?youtube.com\/embed\/[A-z0-9]+$/',$request->video_link);
            dd($validate);
            if(!$validate)
            {
                $invalid_url = "This Link Is Invalid";
                if ($request->id == '') {
                    $subject = Subject::get();
                    return view('backend.chaptercontent.addform')->with(compact('invalid_url','subject'));
                }
                else{
                    $subject = Subject::get();
                    return view('backend.chaptercontent.editform')->with(compact('invalid_url','subject'));
                }
            }*/

            if($request->file('content_type') != null)
            {
                $ext = $request->file('content_type')->getClientOriginalExtension();
                $size = $request->file('content_type')->getSize();

                if ($size > 5000000) {
                    $errors1['size'] = "Size Should Be Less Than 5MB";
                    if ($request->id == ''){
                        $subject = Subject::get();
                        return view('backend.chaptercontent.addform')->with(compact('errors1','subject'));
                    }
                    else{
                        $subject = Subject::get();
                        return view('backend.chaptercontent.addform')->with(compact('errors1','subject'));
                    }
                }
                elseif ($ext != "jpeg" && $ext != "png" && $ext != "jpg" && $ext != "pdf" && $ext != "docx" && $ext != "doc" && $ext != "xlsx" && $ext != "csv")
                {
                    $errors1['extension'] = "Invalid File Format";
                    if ($request->id == ''){
                        $subject = Subject::get();
                        return view('backend.chaptercontent.addform')->with(compact('errors1','subject'));
                    }
                    else{
                        $subject = Subject::get();
                        return view('backend.chaptercontent.addform')->with(compact('errors1','subject'));
                    }
                }
            }

            if ($request->id != '') {
                $chaptercontentdata = Chaptercontent::findOrFail($request->id);
            } else {
                $chaptercontentdata = new Chaptercontent();
            }


            if($request->file('content_type') != null)
            {
                if($request->id != ''){
                    /*$path_to_delete = public_path('chaptercontent\\'.$request->image_name_to_delete);*/
                    $path_to_delete = public_path('chaptercontent//'.$request->image_name_to_delete);
                    if (file_exists($path_to_delete)){
                        unlink($path_to_delete);
                    }
                }


                $file = $request->file('content_type');
                $pathfile = md5($file->getClientOriginalName(). time()).".".$ext;
                $file->move(public_path('chaptercontent'), $pathfile);

                $chaptercontentdata->subject_id = $request['subject_name'];
                $chaptercontentdata->class_id = $request['class_name'];
                $chaptercontentdata->chapter_id = $request['chapter_name'];
                $chaptercontentdata->content_title =  $request['content_title'];
                $chaptercontentdata->content_type = $pathfile;
                $chaptercontentdata->content_link = $request['video_link'];
                $chaptercontentdata->content_short_desc = $request['content_description'];
                $chaptercontentdata->save();
            }
            else
            {
                $chaptercontentdata->subject_id = $request['subject_name'];
                $chaptercontentdata->class_id = $request['class_name'];
                $chaptercontentdata->chapter_id = $request['chapter_name'];
                $chaptercontentdata->content_title =  $request['content_title'];
                $chaptercontentdata->content_link = $request['video_link'];
                $chaptercontentdata->content_short_desc = $request['content_description'];
                $chaptercontentdata->save();
            }


            if ($request->id != '') {
                toastr()->success('', 'Content has been updated', ['timeOut' => 5000]);
            } else {
                toastr()->success('', 'Content has been created', ['timeOut' => 5000]);
            }
        } catch (Exception $e) {

            toastr()->warning('', 'Something went wrong', ['timeOut' => 5000]);
        }

        return redirect()->route('admin.schoolchaptercontent.list');
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
        $chaptercontent = Chaptercontent::find($id);

        $subject = Subject::get();
        $subjectid = Subject::find($chaptercontent->subject_id);

        $class = Schoolclass::get();
        $classid = Schoolclass::find($chaptercontent->class_id);

        $chapter = Chapter::get();
        $chapterid = Chapter::find($chaptercontent->chapter_id);


        return view('backend.chaptercontent.editform', compact('chaptercontent','subject','class','chapter','subjectid','classid','chapterid'));
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

    public function delete($id){
        $res=Chaptercontent::where('id',$id)->get();
        foreach ($res as $val){
            $path = public_path('chaptercontent//'.$val['content_type']);
            //$path = public_path('\chaptercontent\\'.$val['content_type']);
            break;
        }

        if (file_exists($path)){
            unlink($path);
        }
        $res=Chaptercontent::where('id',$id)->delete();
        if($res) {
            toastr()->error('', 'Chapter Content has been Deleted', ['timeOut' => 5000]);
            return redirect()->route('admin.schoolchaptercontent.list');
        }
    }

    public function fetchclass(Request $request)
    {
        $value = $request->get('value');
        $data = Schoolclass::where('subject_id',$value)->get();
        if($data != null){
            $output = '<option disabled selected>---SELECT CLASS---</option>';
            foreach($data as $row)
            {
                $output .= '<option value="'.$row->id.'">'.$row->class_name.'</option>';
            }
            return response()->json($output);
        }
        else
        {
            $output = '<option disabled selected>---SELECT CLASS---</option>';
            return response()->json($output);
        }

    }
    public function fetchchapter(Request $request)
    {
        $value = $request->get('value');
        $data = Chapter::where('class_id',$value)->get();
        if($data != null){
            $output = '<option disabled selected>---SELECT CHAPTER---</option>';
            foreach($data as $row)
            {
                $output .= '<option value="'.$row->id.'">'.$row->chapter_name.'</option>';
            }
            return response()->json($output);
        }
        else
        {
            $output = '<option disabled selected>---SELECT CHAPTER---</option>';
            return response()->json($output);
        }

    }
}
