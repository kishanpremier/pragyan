<?php

namespace App\Http\Controllers\Backend\Notification;

use App\Models\School\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $val = Notification::get();
        return view('backend.notify.index')->with(compact('val'));
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.notify.addform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'title' => 'required',
                'notify_description' => 'required',
            ]);

            if ($request->id != '') {
                $notify = Notification::findOrFail($request->id);
            } else {
                $notify = new Notification();
            }

            if($request->file('notify_image') != null)
            {
                $ext = $request->file('notify_image')->getClientOriginalExtension();
                $size = $request->file('notify_image')->getSize();
                if ($size > 2000000) {
                    $errors1['size'] = "Size Should Be Less Than 2MB";
                    if ($request->id == ''){
                        return view('backend.notify.addform')->with(compact('errors1'));
                    }
                    else{
                        return view('backend.notify.editform')->with(compact('errors1'));
                    }
                }
                elseif ($ext != "jpeg" && $ext != "png" && $ext != "jpg")
                {
                    $errors1['extension'] = "Invalid File Format";
                    if ($request->id == ''){
                        return view('backend.notify.addform')->with(compact('errors1'));
                    }
                    else{
                        return view('backend.notify.editform')->with(compact('errors1'));
                    }
                }
                $file = $request->file('notify_image');
                $pathfile = md5($file->getClientOriginalName(). time()).".".$ext;
                $file->move(public_path('notify'), $pathfile);

                $notify->title = $request['title'];
                $notify->desc = $request['notify_description'];
                $notify->image = $pathfile;
                $notify->save();
            }
            else{
                $notify->title = $request['title'];
                $notify->desc = $request['notify_description'];
                $notify->save();
            }

            if ($request->id != '') {
                toastr()->success('', 'Notification has been updated', ['timeOut' => 5000]);
            } else {
                toastr()->success('', 'Notification has been created', ['timeOut' => 5000]);
            }
        }
        catch (Exception $e)
        {
            toastr()->warning('', 'Something went wrong', ['timeOut' => 5000]);
        }
        return redirect()->route('admin.notify.create');
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
    public  function  delete($id)
    {

    }
}
