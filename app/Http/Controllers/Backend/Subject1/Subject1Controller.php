<?php

namespace App\Http\Controllers\Backend\Subject1;

use App\Models\School\Subject;
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
        return view('backend.subject1.addform');
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
                'subject_name' => 'required|unique:subject',
                'school_subject_image' => 'required'
            ]);

            $ext = $request->file('school_subject_image')->getClientOriginalExtension();
            $size = $request->file('school_subject_image')->getSize();
            if($size > 2000000)
            {
                $errors1['size'] = "Size Should Be Less Than 2MB";
            }
            elseif ($ext != "jpeg" && $ext != "png" && $ext != "jpg")
            {
                $errors1['extension'] = "Invalid File Format";
                if($request->id == '')
                    return view('backend.subject1.addform')->with(compact('errors1'));
                else
                    return view('backend.subject1.editform')->with(compact('errors1'));
            }

            if ($request->id != '') {
                $Schoolsubject = Subject::findOrFail($request->id);
                $id = $request->id;
            } else {
                $Schoolsubject = new Subject();
                $val = Subject::orderBy('id', 'DESC')->first();
                $id = $val['id'] + 1;
            }

            $Schoolsubject->subject_name = $request['subject_name'];
            $Schoolsubject->subject_image = $id.".".$ext;
            $Schoolsubject->save();

            if ($request->id != '') {
                toastr()->success('', 'Class has been updated', ['timeOut' => 5000]);
            } else {
                toastr()->success('', 'Class has been created', ['timeOut' => 5000]);
            }
        } catch (Exception $e) {

            toastr()->warning('', 'Something went wrong', ['timeOut' => 5000]);
        }

        return redirect()->route('admin.class.list');
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
