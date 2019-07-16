<?php

namespace App\Http\Controllers\Backend\Board;

use App\Models\School\Schoolboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Schoolboard = Schoolboard::get();
        return view('backend.schoolboard.index', compact('Schoolboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.schoolboard.addform');
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
                'state_board_name' => 'required|unique:state_board',
            ]);

            if ($request->id != '') {
                $Schoolboard = Schoolboard::findOrFail($request->id);
            } else {
                $Schoolboard = new Schoolboard();
            }

            $Schoolboard->state_board_name = $request['state_board_name'];

            $Schoolboard->save();

            if ($request->id != '') {
                toastr()->success('', 'Board has been updated', ['timeOut' => 5000]);
            } else {
                toastr()->success('', 'Board has been created', ['timeOut' => 5000]);
            }
        } catch (Exception $e) {

            toastr()->warning('', 'Something went wrong', ['timeOut' => 5000]);
        }

        return redirect()->route('admin.board.list');
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
        $SchoolboardEdit = Schoolboard::find($id);
        return view('backend.schoolboard.editform', compact('SchoolboardEdit'));
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
        $res=Schoolboard::where('id',$id)->delete();
        if($res) {
            toastr()->error('', 'SchoolBoard has been Deleted', ['timeOut' => 5000]);
            return redirect()->route('admin.board.list');
        }
    }
}
