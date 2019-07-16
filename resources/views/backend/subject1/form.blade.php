         <div class="box-body">
             <div class="form-group">
                 <label for="school_name" class="col-sm-2 control-label"><b>School Name:</b></label>
                 <div class="col-sm-12">
                     <select name="school_name"class="form-control {{ $errors->has('school_name') ? ' is-invalid' : '' }}" required>
                         @foreach($val as $key)
                             @if(isset($schoolsubject))
                                 @if($schoolsubject->school_id == $key['id'])
                                     <option value="{{$key['id']}}" selected>{{$key['school_name']}}</option>
                                 @else
                                     <option value="{{$key['id']}}">{{$key['school_name']}}</option>
                                 @endif
                             @else
                                 <option value="{{$key['id']}}">{{$key['school_name']}}</option>
                             @endif
                         @endforeach
                     </select>
                 </div>
             </div>
            <div class="form-group">
                <label for="subject_name" class="col-sm-2 control-label"><b>Name:</b></label>
                <div class="col-sm-12">
                    <input type="hidden" name="id" @if(isset($schoolsubject->id)) value="{{$schoolsubject->id}}" @endif>
                    <input type="text" id="subject_name" name="subject_name" class="form-control {{ $errors->has('subject_name') ? ' is-invalid' : '' }}"
                           @if(isset($schoolsubject))value="{{old('subject_name') ? old('subject_name') : ( ($schoolsubject->subject_name) ? $schoolsubject->subject_name : '' )}}"@endif required>
                @if($errors->has('subject_name'))
                <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">*{{ $errors->first('subject_name') }}</strong>
                </span>
                @endif
                </div>
            </div>
             <div class="form-group">
                 <label for="subject_image" class="col-sm-3 control-label"><b>Select Image(Max=2MB):</b></label>
                 <div class="col-sm-12">
                     <input type="file" id="subject_image" onchange="readURL(this);" name="subject_image" class="form-control {{ $errors->has('subject_image') ? ' is-invalid' : '' }}" >
                     @if($errors->has('subject_image'))
                     <span id="invalid-feedback" role="alert">
                        <strong id="error" style="color: red">*{{ $errors->first('subject_image') }}</strong>
                    </span>
                     @endif
                 </div>
             </div>
             <div class="form-group">
                 <div class="col-sm-12">
                     <img id="imgsubject" @if(isset($schoolsubject))src="{{asset('/subjectimages/').'/'.$schoolsubject['subject_image']}}" height="200" width="150" @endif alt="Your Image">
                     @if(isset($errors1))
                         <span id="invalid-feedback" role="alert">
                            <strong id="error" style="color: red">*
                                @foreach($errors1 as $val)
                                    {{$val}}
                                @endforeach
                            </strong>
                        </span>
                     @endif
                 </div>
             </div>
        </div><!-- /.box-body -->