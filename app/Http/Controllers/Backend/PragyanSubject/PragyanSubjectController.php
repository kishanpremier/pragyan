<?php

namespace App\Http\Controllers\Backend\PragyanSubject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\School\Subject;
use App\Models\School\School;

class PragyanSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolsubject = Subject::get();
        return view('backend.pragyansubject.index', compact('schoolsubject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pragyansubject.addform');
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

                    'subject_name' => 'required',
                    'subject_image' => 'required',
                ]);
            }
            else{
                $request->validate([
                    'subject_name' => 'required'
                ]);
            }
            if($request->file('subject_image') != null)
            {
                $ext = $request->file('subject_image')->getClientOriginalExtension();
                $size = $request->file('subject_image')->getSize();

                if ($size > 2000000) {
                    $errors1['size'] = "Size Should Be Less Than 2MB";
                    if ($request->id == ''){
                        return view('backend.pragyansubject.addform')->with(compact('errors1'));
                    }
                    else{
                        return view('backend.pragyansubject.editform')->with(compact('errors1'));
                    }
                } elseif ($ext != "jpeg" && $ext != "png" && $ext != "jpg") {
                    $errors1['extension'] = "Invalid File Format";
                    if ($request->id == ''){
                        return view('backend.pragyansubject.addform')->with(compact('errors1'));
                    }
                    else{
                        return view('backend.pragyansubject.editform')->with(compact('errors1'));
                    }
                }
            }
            if ($request->id != '') {
                $Schoolsubject = Subject::findOrFail($request->id);
            } else {
                $Schoolsubject = new Subject();
            }


            if($request->file('subject_image') != null)
            {
                if($request->id != '')
                {
                    //$path_to_delete = public_path('\subjectimages\\'.$request->image_name_to_delete);
                    $path_to_delete = public_path('subjectimages//'.$request->image_name_to_delete);
                    if (file_exists($path_to_delete)){
                        unlink($path_to_delete);
                    }
                }

                $file = $request->file('subject_image');
                $pathfile = md5($file->getClientOriginalName(). time()).".".$ext;
                $file->move(public_path('subjectimages'), $pathfile);

                $Schoolsubject->subject_name = $request['subject_name'];
                $Schoolsubject->subject_image = $pathfile;
                $Schoolsubject->save();
            }
            else
            {
                $Schoolsubject->subject_name = $request['subject_name'];
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
        return view('backend.pragyansubject.editform', compact('schoolsubject','val'));
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
        foreach ($res as $val){
            /*$path = public_path('\subjectimages\\'.$val['subject_image']);*/
            $path = public_path('subjectimages//'.$val['subject_image']);
            break;
        }

        if (file_exists($path)){
            unlink($path);
        }
        $res=Subject::where('id',$id)->delete();
        if($res) {
            toastr()->error('', 'Subject has been Deleted', ['timeOut' => 5000]);
            return redirect()->route('admin.subjectschool.list');
        }
    }
}
