<?php

namespace App\Http\Controllers\Backend\Subject;

use App\Models\School\School;
use App\Models\School\Schoolclass;
use App\Models\School\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = Schoolclass::get();
        return view('backend.subject.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $val = Subject::get();
        return view('backend.subject.addform')->with(compact('val'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        try {

            $request->validate([
                'class_name' => 'required',
                'subject_name' => 'required|integer',
            ]);

            if ($request->id != '') {
                $Schoolclass = Schoolclass::findOrFail($request->id);
            } else {
                $Schoolclass = new Schoolclass();
            }

            $Schoolclass->class_name = $request['class_name'];
            $Schoolclass->subject_id = $request['subject_name'];
            $Schoolclass->save();

            if ($request->id != '') {
                toastr()->success('', 'Class has been updated', ['timeOut' => 5000]);
            } else {
                toastr()->success('', 'Class has been created', ['timeOut' => 5000]);
            }
        }
        catch(Exception $e)
        {
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

        $val = Subject::get();
        $SchoolclassEdit = Schoolclass::find($id);
        return view('backend.subject.editform', compact('SchoolclassEdit','val'));
        
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
    public function delete($id){
        $res=Schoolclass::where('id',$id)->delete();
        if($res) {
            toastr()->error('', 'Class has been Deleted', ['timeOut' => 5000]);
            return redirect()->route('admin.class.list');
        }
    }

}
