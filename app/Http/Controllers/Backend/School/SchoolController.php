<?php

namespace App\Http\Controllers\Backend\School;

use App\Models\School\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $School = School::get();
        return view('backend.school.index', compact('School'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.school.addform');
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
                'school_name' => 'required|unique:school,school_name,'.$request->id,
            ]);

            if ($request->id != '') {
                $School = School::findOrFail($request->id);
            } else {
                $School = new School();
            }

            $School->school_name = $request['school_name'];

            $School->save();

            if ($request->id != '') {
                toastr()->success('', 'School has been updated', ['timeOut' => 5000]);
            } else {
                toastr()->success('', 'School has been created', ['timeOut' => 5000]);
            }
        } catch (Exception $e) {

            toastr()->warning('', 'Something went wrong', ['timeOut' => 5000]);
        }

        return redirect()->route('admin.school.list');
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
        $SchoolEdit = School::find($id);
        return view('backend.school.editform', compact('SchoolEdit'));
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
        $res=School::where('id',$id)->delete();
        if($res) {
            toastr()->error('', 'School has been Deleted', ['timeOut' => 5000]);
            return redirect()->route('admin.school.list');
        }
    }
}
