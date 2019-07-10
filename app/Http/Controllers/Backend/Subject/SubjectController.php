<?php

namespace App\Http\Controllers\Backend\Subject;

use Illuminate\Support\Facades\Validator;
use App\Models\Subject\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.subject.index');
    }

    public function listing()
    {
        $abc = Datatables::of($this->pages->getForDataTable());
        foreach ($abc as $val){
            return response()->json($val);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subject.dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $abc = Validator::make($request->all(), [ // <---
            'class_name' => 'required|unique:class',
        ]);

        if($abc->fails()){
            $status = "Fail";
            $msg = $abc->errors()->first();
            return view('backend.subject.dashboard',compact('status','msg'));
        }
        else{
            $obj = new Subject;
            $obj->class_name = $request->input('class_name');
            $obj->save();
            toastr()->success('Class has been Inserted', 'Successfully Inserted', ['timeOut' => 5000]);
            return redirect()->route('admin.subject.create');
        }
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
