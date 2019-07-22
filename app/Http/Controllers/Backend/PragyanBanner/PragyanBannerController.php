<?php

namespace App\Http\Controllers\Backend\PragyanBanner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\School\Banner;

class PragyanBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannerdata = Banner::get();
        return view('backend.pragyanbanner.index')->with(compact('bannerdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pragyanbanner.addform');
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
            if($request->video_url == null){
                $request->validate([
                    'title' => 'required',
                    'doctype' => 'required|integer',
                    'banner_image_other' => 'required',
                    'banner_image' => 'required'
                ]);
            }
            else{
                $request->validate([
                    'title' => 'required',
                    'doctype' => 'required|integer',
                    'banner_image' => 'required',
                    'video_url' => 'required'
                ]);
            }
            /*===================Object For Storing===================================================*/
            if ($request->id != '')
            {
                $banner = Banner::findOrFail($request->id);
            }
            else
            {
                $banner = new Banner();
            }
            $pathfile = null;
            $pathfile1 = null;
            /*============================Validating Image File===========================================*/
            if($request->file('banner_image') != null)
            {
                $ext = $request->file('banner_image')->getClientOriginalExtension();
                $size = $request->file('banner_image')->getSize();

                if ($size > 2000000)
                {
                    $errors1['size'] = "Size Should Be Less Than 2MB";
                    if ($request->id == '')
                        return view('backend.pragyanbanner.addform')->with(compact('errors1'));
                    else
                        return view('backend.pragyanbanner.addform')->with(compact('errors1'));
                }
                elseif($ext != "jpeg" && $ext != "png" && $ext != "jpg")
                {
                    $errors1['extension'] = "Invalid File Format";
                    if ($request->id == '')
                        return view('backend.pragyanbanner.addform')->with(compact('errors1'));
                    else
                        return view('backend.pragyanbanner.addform')->with(compact('errors1'));
                }
                else
                {
                    $file = $request->file('banner_image');
                    $pathfile = md5($file->getClientOriginalName() . time()) . "." . $ext;
                    $file->move(public_path('banner'), $pathfile);
                }
            }
            /*=====================Validating Optional Image File==================================================*/
            if($request->file('banner_image_other') != null)
            {
                $ext = $request->file('banner_image_other')->getClientOriginalExtension();
                $size = $request->file('banner_image_other')->getSize();

                if ($size > 2000000)
                {
                    $errors1['size'] = "Size Should Be Less Than 2MB";
                    return view('backend.pragyanbanner.addform')->with(compact('errors1'));
                }
                elseif($ext != "jpeg" && $ext != "png" && $ext != "jpg" && $ext != "pdf"  && $ext != "docx"  && $ext != "xlsx"  && $ext != "doc"  && $ext != "csv")
                {
                    $errors1['extension'] = "Invalid File Format";
                    if ($request->id == '')
                        return view('backend.pragyanbanner.addform')->with(compact('errors1'));
                    else
                        return view('backend.pragyanbanner.addform')->with(compact('errors1'));
                }
                else
                {
                    if($request->id != '')
                    {
                        //$path_to_delete = public_path('\subjectimages\\'.$request->image_name_to_delete);
                        $path_to_delete = public_path('banner//'.$request->image_name_to_delete);
                        if (file_exists($path_to_delete)){
                            unlink($path_to_delete);
                        }
                    }
                    $file = $request->file('banner_image_other');
                    $pathfile1 = md5($file->getClientOriginalName() . time()) . "." . $ext;
                    $file->move(public_path('banner'), $pathfile1);
                }
            }

            $banner->title = $request['title'];
            $banner->doc_type = $request['doctype'];
            $banner->image_name = $pathfile;
            $banner->document = $pathfile1;
            $banner->video_link = $request['video_url'];
            $banner->save();

            if ($request->id != '') {
                toastr()->success('', 'Banner has been updated', ['timeOut' => 5000]);
            } else {
                toastr()->success('', 'Banner has been created', ['timeOut' => 5000]);
            }
        }
        catch(Exception $e)
        {
            toastr()->warning('', 'Something went wrong', ['timeOut' => 5000]);
        }
        return redirect()->route('admin.banner.list');
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
        $da = Banner::where('id',$id)->get();
        foreach ($da as $data)
            return view('backend.pragyanbanner.editform')->with(compact('data'));

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

    public function delete($id)
    {
        $res = Banner::where('id', $id)->get();
        foreach ($res as $val) {
            $path = public_path('banner//' . $val['image_name']);
            $document = public_path('banner//' . $val['document']);
            break;
        }

        if (file_exists($path)) {
            unlink($path);
        }
        if (file_exists($document)) {
            unlink($document);
        }
        $res = Banner::where('id', $id)->delete();
        if ($res) {
            toastr()->error('', 'Banner has been Deleted', ['timeOut' => 5000]);
            return redirect()->route('admin.banner.list');
        }
    }
}
