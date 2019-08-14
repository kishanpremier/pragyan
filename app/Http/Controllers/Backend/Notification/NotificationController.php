<?php

namespace App\Http\Controllers\Backend\Notification;
use App\Models\Access\User\User;
use App\Models\School\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Edujugon\PushNotification\PushNotification;

class NotificationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
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
    public function create() {
        return view('backend.notify.addform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request) {
          
          $userToken = User::pluck('device_token')->toArray();
       
          $push = new PushNotification('fcm');
        if ($request->file('notify_image') != null) {
            $size = $request->file('notify_image')->getSize();
            if ($size > 2000000) {
                $errors1['size'] = "Size Should Be Less Than 2MB";
                return view('backend.notify.addform')->with(compact('errors1'));
            }

            $file = $request->file('notify_image');
            $ext = $request->file('notify_image')->getClientOriginalExtension();
            $pathfile = md5($file->getClientOriginalName() . time()) . "." . $ext;
            $file->move(public_path('notify'), $pathfile);
            $image = $pathfile;
        } else {
            $image = '';
        }
         $title = $request['title'];
         $desc = $request['notify_description'];

          $push->setMessage([
              'notification' => [
                  'title'=>$title,
                  'body'=>$desc,
                  'image'=>'notify/'.$image,
                  'sound' => 'default'
              ]
          ])

              ->setApiKey('AIzaSyAKj0dRf11kbgU7McEEUdEHRAPN5Eixbpk')
              ->setDevicesToken($userToken)
              ->send()
              ->getFeedback();

        toastr()->success('', 'Notification has been created', ['timeOut' => 5000]);
        return redirect('admin/dashboard');
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
        //
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

    public function delete($id) {
        
    }

}
