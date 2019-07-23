
        <div class="box-body">
             <div class="form-group">
                 <div class="col-sm-12">
                    <label for="doctype" class="control-label"><b>Document Type:</b></label>
                     <select name="doctype" id="doctype" class="form-control {{ $errors->has('doctype') ? ' is-invalid' : '' }}" required>
                         <option selected disabled value="0">---SELECT TYPE---</option>
                         @if(isset($data))
                             @if($data->doc_type == 1)
                                 <option value="1" selected>Image</option>
                             @else
                                 <option value="1">Image</option>
                             @endif
                             @if($data->doc_type == 2)
                                 <option value="2" selected>Video</option>
                             @else
                                 <option value="2">Video</option>
                             @endif
                             @if($data->doc_type == 3)
                                 <option value="3" selected>Document</option>
                             @else
                                 <option value="3">Document</option>
                             @endif
                         @else
                             <option value="1">Image</option>
                             <option value="2">Video</option>
                             <option value="3">Document</option>
                         @endif
                     </select>
                 </div>
             </div>
            <div class="form-group">
                
                <label for="title" class="col-sm-12 control-label"><b>Banner Title:</b></label>
                <div class="col-sm-12">
                    <input type="hidden" name="id" @if(isset($data->id)) value="{{$data->id}}" @endif>
                    <input type="title" id="tilte" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                           @if(isset($data))value="{{old('title') ? old('title') : ( ($data->title) ? $data->title: '' )}}"@endif>
                    @if($errors->has('title'))
                        <span id="invalid-feedback" role="alert">
                            <strong id="error" style="color: red">*{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
               
                <label for="banner_image" class="col-sm-12 control-label"><b>Upload Image:</b></label>
                <div class="col-sm-12">
                    <input type="file" id="banner_image" onchange="readURL(this)" name="banner_image" class="form-control {{ $errors->has('banner_image') ? ' is-invalid' : '' }}"
                           @if(isset($data))value="{{old('banner_image') ? old('banner_image') : ( ($data->banner_image) ? $data->banner_image : '' )}}"@endif>
                @if($errors->has('banner_image'))
                    <span id="invalid-feedback" role="alert">
                        <strong id="error" style="color: red">*{{ $errors->first('banner_image') }}</strong>
                    </span>
                @endif
                </div>
            </div>
            <div class="form-group">

                <div class="col-sm-12">
                    <img id="imgsubject" @if(isset($data))src="{{asset('/banner/').'/'.$data->image_name}}" height="200" width="150" @endif>
                </div>
            </div>
            <div class="form-group">

                <div class="col-sm-12" id="video_url_id" style="display: none;">
                    <label for="video_url" class="control-label"><b>Video URL:</b></label>
                    <input type="text" id="video_url" name="video_url" class="form-control {{ $errors->has('video_url') ? ' is-invalid' : '' }}"
                           @if(isset($data))value="{{old('video_url') ? old('video_url') : ( ($data->video_url) ? $data->video_url : '' )}}"@endif>
                    @if($errors->has('video_url'))
                        <span id="invalid-feedback" role="alert">
                            <strong id="error" style="color: red">*{{ $errors->first('video_url') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <br/><br/><br/>
                <div class="col-sm-12" id="banner_image_other_id" style="display: none;">
                    <label for="banner_image_other" class="col-sm-12 control-label"><b>Upload Image or Document:</b></label>
                    <input type="file" id="banner_image_other" onchange="readURLother(this)" name="banner_image_other" class="form-control {{ $errors->has('banner_image_other') ? ' is-invalid' : '' }}"
                           @if(isset($data))value="{{old('banner_image_other') ? old('banner_image_other') : ( ($data->banner_image_other) ? $data->banner_image_other : '' )}}"@endif>
                    @if($errors->has('banner_image_other'))
                        <span id="invalid-feedback" role="alert">
                            <strong id="error" style="color: red">{{ $errors->first('banner_image_other') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div><!-- /.box-body -->