<?php

namespace App\Http\Controllers\Backend\Chapter;

use App\Models\School\School;
use App\Models\School\Schoolclass;
use App\Models\School\Chapter;
use App\Models\School\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapter = Chapter::query()
                ->leftjoin('subject', 'subject.id', '=', 'chapter.subject_id')
                ->leftJoin('class','class.id','=','chapter.class_id')
                ->select([
                    'chapter.id',
                    'chapter.chapter_name',
                    'subject.subject_name',
                    'class.class_name'
                ])
                ->get();
        //$chapter = Chapter::get();
        return view('backend.chapter.index', compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $val = Subject::get();
        $val1 = Schoolclass::get();
        return view('backend.chapter.addform')->with(compact('val','val1'));
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

            $request->validate([
                'class_name' => 'required|integer',
                'subject_name' => 'required|integer',
                'chapter_name' => 'required'
            ]);

            if ($request->id != '') {
                $chapter = Chapter::findOrFail($request->id);
            } else {
                $chapter = new Chapter();
            }

            $chapter->class_id = $request['class_name'];
            $chapter->subject_id = $request['subject_name'];
            $chapter->chapter_name = $request['chapter_name'];
            $chapter->save();

            if ($request->id != '') {
                toastr()->success('', 'Chapter has been updated', ['timeOut' => 5000]);
            } else {
                toastr()->success('', 'Chapter has been created', ['timeOut' => 5000]);
            }
        }
        catch(Exception $e)
        {
            toastr()->warning('', 'Something went wrong', ['timeOut' => 5000]);
        }
        return redirect()->route('admin.schoolchapter.list');
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
        $val = Subject::get();
        $data = Chapter::find($id);
        $classdata = Schoolclass::find($data->class_id);
        return view('backend.chapter.editform', compact('data','val','classdata'));
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
        $res=Chapter::where('id',$id)->delete();
        if($res) {
            toastr()->error('', 'Chapter has been Deleted', ['timeOut' => 5000]);
            return redirect()->route('admin.schoolchapter.list');
        }
    }

    public function fetchclass(Request $request)
    {
        $value = $request->get('value');
        $data = Schoolclass::where('subject_id',$value)->get();
        if($data != null){
            $output = '';
            foreach($data as $row)
            {
                $output .= '<option value="'.$row->id.'">'.$row->class_name.'</option>';
            }
            return response()->json($output);
        }
        else
        {
            $output = '';
            return response()->json($output);
        }

    }
}
