         <div class="box-body">
            <div class="form-group">
                <label for="class_name" class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-12">
                    <input type="hidden" name="id" @if(isset($SchoolclassEdit->id)) value="{{$SchoolclassEdit->id}}" @endif>
                    <input type="text" id="subject_name" name="subject_name" class="form-control {{ $errors->has('subject_name') ? ' is-invalid' : '' }}"
                           @if(isset($SchoolclassEdit))value="{{old('subject_name') ? old('subject_name') : ( ($SchoolclassEdit->subject_name) ? $SchoolclassEdit->subject_name : '' )}}"@endif required>
                @if($errors->has('subject_name'))
                <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">*{{ $errors->first('subject_name') }}</strong>
                </span>
                @endif
                </div>
            </div>
             <div class="form-group">
                 <label for="class_name" class="col-sm-3 control-label">Select Image(Max=2MB):</label>
                 <div class="col-sm-12">
                     <input type="file" id="school_subject_image" onchange="readURL(this);" name="school_subject_image" class="form-control {{ $errors->has('school_subject_image') ? ' is-invalid' : '' }}"
                     @if(isset($SchoolclassEdit))value="{{old('school_subject_image') ? old('school_subject_image') : ( ($SchoolclassEdit->school_subject_image) ? $SchoolclassEdit->school_subject_image : '' )}}"@endif required>
                     @if($errors->has('school_subject_image'))
                     <span id="invalid-feedback" role="alert">
                        <strong id="error" style="color: red">*{{ $errors->first('school_subject_image') }}

                        </strong>
                    </span>
                     @endif
                 </div>
             </div>
             <div class="form-group">
                 <div class="col-sm-12">
                     <img id="imgsubject" src="#" alt="Your Image">
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