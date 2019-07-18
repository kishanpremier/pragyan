
        <div class="box-body">
             <div class="form-group">
                 <div class="col-sm-4">
                    <label for="subject_name" class="col-sm-6 control-label"><b>Subject Name:</b></label>
                     <select name="subject_name" id="subject_name" class="form-control {{ $errors->has('subject_name') ? ' is-invalid' : '' }}" required>
                         <option disabled selected>---SELECT SUBJECT---</option>
                         @foreach($subject as $key)
                             @if(isset($subjectid))
                                 @if($subjectid->id == $key['id'])
                                     <option value="{{$key['id']}}" selected>{{$key['subject_name']}}</option>
                                 @else
                                     <option value="{{$key['id']}}">{{$key['subject_name']}}</option>
                                 @endif
                             @else
                                 <option value="{{$key['id']}}">{{$key['subject_name']}}</option>
                             @endif
                         @endforeach
                     </select>
                     @if($errors->has('subject_name'))
                     <span id="invalid-feedback" role="alert">
                        <strong id="error" style="color: red">*{{ $errors->first('subject_name') }}</strong>
                     </span>
                     @endif
                     <br/>
                 </div>
                 <div class="col-sm-4">
                     <label for="class_name" class="col-sm-4 control-label"><b>Class Name:</b></label>
                     <select name="class_name" id="class_name" class="form-control {{ $errors->has('class_name') ? ' is-invalid' : '' }}">
                         @if(isset($classid))
                             <option value="{{$classid->id}}">{{$classid->class_name}}</option>
                         @endif
                     </select>
                     @if($errors->has('class_name'))
                         <span id="invalid-feedback" role="alert">
                            <strong id="error" style="color: red">*{{ $errors->first('class_name') }}</strong>
                         </span>
                     @endif
                     <br/>
                 </div>
                 <div class="col-sm-4">
                     <label for="chapter_name" class="col-sm-4 control-label"><b>ChapterName:</b></label>
                     <select name="chapter_name" id="chapter_name" class="form-control {{ $errors->has('class_name') ? ' is-invalid' : '' }}">
                         @if(isset($chapterid))
                             <option value="{{$chapterid->id}}">{{$chapterid->chapter_name}}</option>
                         @endif
                     </select>
                     @if($errors->has('chapter_name'))
                     <span id="invalid-feedback" role="alert">
                        <strong id="error" style="color: red">*{{ $errors->first('chapter_name') }}</strong>
                     </span>
                     @endif
                     <br/>
                 </div>
             </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="content_title" class="col-sm-6 control-label"><b>Content Title:</b></label>
                    <input type="hidden" name="image_name_to_delete" @if(isset($chaptercontent->id)) value="{{$chaptercontent->content_type}}" @endif>
                    <input type="hidden" name="id" @if(isset($chaptercontent->id)) value="{{$chaptercontent->id}}" @endif>
                    <input type="text" id="content_title" name="content_title" class="form-control {{ $errors->has('content_title') ? ' is-invalid' : '' }}"
                           @if(isset($chaptercontent))value="{{old('content_title') ? old('content_title') : ( ($chaptercontent->content_title) ? $chaptercontent->content_title : '' )}}"@endif>
                    @if($errors->has('content_title'))
                        <span id="invalid-feedback" role="alert">
                        <strong id="error" style="color: red">*{{ $errors->first('content_title') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-sm-6">
                    <label for="content_type" class="col-sm-6 control-label"><b>Content Type:</b></label>
                    <input type="file" id="content_type" onchange="readURL(this);" name="content_type" class="form-control {{ $errors->has('content_type') ? ' is-invalid' : '' }}"
                           @if(isset($chaptercontent))value="{{old('content_type') ? old('content_type') : ( ($chaptercontent->content_type) ? $chaptercontent->content_type : '' )}}"@endif>
                    @if($errors->has('content_type'))
                        <span id="invalid-feedback" role="alert">
                            <strong id="error" style="color: red">*{{ $errors->first('content_type') }}</strong>
                        </span>
                    @endif
                    <br/>
                </div>
            </div>
            <div class="form-group">
                <label for="video_link" class="col-sm-2 control-label"><b>Video Link:</b></label>
                <div class="col-sm-12">
                    <input type="text" id="video_link" name="video_link" class="form-control {{ $errors->has('video_link') ? ' is-invalid' : '' }}"
                           @if(isset($chaptercontent))value="{{old('video_link') ? old('video_link') : ( ($chaptercontent->content_link) ? $chaptercontent->content_link : '' )}}"@endif>
                    @if($errors->has('video_link'))
                        <span id="invalid-feedback" role="alert">
                            <strong id="error" style="color: red">*{{ $errors->first('video_link') }}</strong>
                        </span>
                    @endif
                    <br/>
                </div>
            </div>
            <div class="form-group">
                <label for="content_desc" class="col-sm-2 control-label"><b>Content Description:</b></label>
                <div class="col-sm-12">
                    <textarea name="content_description" id="content_description" class="form-control {{ $errors->has('content_description') ? ' is-invalid' : '' }}">
                        @if(isset($chaptercontent))
                            {{$chaptercontent->content_short_desc}}
                        @endif
                    </textarea>
                    @if($errors->has('content_description'))
                        <span id="invalid-feedback" role="alert">
                            <strong id="error" style="color: red">*{{ $errors->first('content_description') }}</strong>
                        </span>
                     @endif
                </div>
            </div>
        </div>
        <!-- /.box-body -->
