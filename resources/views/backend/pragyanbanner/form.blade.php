
        <div class="box-body">
             <div class="form-group">
                 <div class="col-sm-12">
                    <label for="doctype" class="col-sm-12 control-label"><b>Document Type:</b></label>
                     <select name="doctype" id="doctype" class="form-control {{ $errors->has('doctype') ? ' is-invalid' : '' }}" required>
                         <option selected disabled>---SELECT TYPE---</option>
                         <option value="1">Image</option>
                         <option value="2">Video</option>
                         <option value="3">Document</option>
                     </select>
                 </div>
             </div>
            <div class="form-group">
                <br/><br/><br/>
                <label for="banner_image" class="col-sm-12 control-label"><b>Upload Image:</b></label>
                <div class="col-sm-12">
                    <input type="hidden" name="id" @if(isset($data->id)) value="{{$data->id}}" @endif>
                    <input type="file" id="banner_image" name="banner_image" class="form-control {{ $errors->has('banner_image') ? ' is-invalid' : '' }}"
                           @if(isset($data))value="{{old('banner_image') ? old('banner_image') : ( ($data->banner_image) ? $data->banner_image : '' )}}"@endif>
                @if($errors->has('banner_image'))
                <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">*{{ $errors->first('banner_image') }}</strong>
                </span>
                @endif
                </div>
            </div>
            <div class="form-group">
                <br/><br/><br/>
                <div class="col-sm-12" id="video_url_id" style="display: none;">
                    <label for="video_url" class="col-sm-12 control-label"><b>Video URL:</b></label>
                    <input type="hidden" name="id" @if(isset($data->id)) value="{{$data->id}}" @endif>
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
                    <input type="hidden" name="id" @if(isset($data->id)) value="{{$data->id}}" @endif>
                    <input type="file" id="banner_image_other" name="banner_image_other" class="form-control {{ $errors->has('banner_image_other') ? ' is-invalid' : '' }}"
                           @if(isset($data))value="{{old('banner_image_other') ? old('banner_image_other') : ( ($data->banner_image_other) ? $data->banner_image_other : '' )}}"@endif>
                    @if($errors->has('banner_image_other'))
                        <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">{{ $errors->first('banner_image_other') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div><!-- /.box-body -->