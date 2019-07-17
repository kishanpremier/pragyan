<?php

namespace App\Http\Controllers\Backend\Subject1;

use App\Models\School\Subject;
use App\Models\School\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Subject1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolsubject = Subject::get();
        return view('backend.subject1.index', compact('schoolsubject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $val = School::get();
        return view('backend.subject1.addform')->with(compact('val'));
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

                    'subject_name' => 'required|unique:subject',
                    'subject_image' => 'required',
                    //'school_name' => 'required|integer'
                ]);
            }
            else{
                $request->validate([
                    //'school_name' => 'required|integer',
                    'subject_name' => 'required|unique:subject,subject_name,'.$request->id
                ]);
            }
            $val = School::get();
            if($request->file('subject_image') != null)
            {
                $ext = $request->file('subject_image')->getClientOriginalExtension();
                $size = $request->file('subject_image')->getSize();

                if ($size > 2000000) {
                    $errors1['size'] = "Size Should Be Less Than 2MB";
                } elseif ($ext != "jpeg" && $ext != "png" && $ext != "jpg") {
                    $errors1['extension'] = "Invalid File Format";
                    if ($request->id == '')
                        return view('backend.subject1.addform')->with(compact('errors1','val'));
                    else
                        return view('backend.subject1.editform')->with(compact('errors1','val'));
                }
            }
            if ($request->id != '') {
                $Schoolsubject = Subject::findOrFail($request->id);
            } else {
                $Schoolsubject = new Subject();
            }


            if($request->file('subject_image') != null)
            {
                /*
                $file = $request->file('subject_image');
                $pathfile = md5($file->getClientOriginalName(). time()).".".$ext;
                $file = $request->file('subject_image')->storeAs('public/subjectimages',$pathfile);
                */

                $file = $request->file('subject_image');
                $pathfile = md5($file->getClientOriginalName(). time()).".".$ext;
                $file->move(public_path('\subjectimages\\'), $pathfile);

                $Schoolsubject->subject_name = $request['subject_name'];
                $Schoolsubject->subject_image = $pathfile;
                //$Schoolsubject->school_id = $request['school_name'];
                $Schoolsubject->save();
            }
            else
            {
                $Schoolsubject->subject_name = $request['subject_name'];
                //$Schoolsubject->school_id = $request['school_name'];
                $Schoolsubject->save();
            }


            if ($request->id != '') {
                toastr()->success('', 'Subject has been updated', ['timeOut' => 5000]);
            } else {
                toastr()->success('', 'Subject has been created', ['timeOut' => 5000]);
            }
        } catch (Exception $e) {

            toastr()->warning('', 'Something went wrong', ['timeOut' => 5000]);
        }

        return redirect()->route('admin.subjectschool.list');
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
        $val = School::get();
        $schoolsubject = Subject::find($id);
        return view('backend.subject1.editform', compact('schoolsubject','val'));
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
        $res=Subject::where('id',$id)->get();
        foreach ($res as $val)
            $path = (base_path('public\\subjectimages\\'.$val['subject_image']));

        unlink(public_path('\subjectimages\\'.$val['subject_image']));

        $res=Subject::where('id',$id)->delete();
        if($res) {
            toastr()->error('', 'Subject has been Deleted', ['timeOut' => 5000]);
            return redirect()->route('admin.subjectschool.list');
        }
    }
}
