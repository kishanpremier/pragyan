
        <div class="box-body">
             <div class="form-group">
                 <div class="col-sm-6">
                    <label for="subject_name" class="col-sm-4 control-label"><b>Subject Name:</b></label>
                     <select name="subject_name" id="subject" class="form-control {{ $errors->has('school_name') ? ' is-invalid' : '' }}" required>
                         @foreach($val as $key)
                             @if(isset($schoolsubject))
                                 @if($schoolsubject->school_id == $key['id'])
                                     <option value="{{$key['id']}}" selected>{{$key['school_name']}}</option>
                                 @else
                                     <option value="{{$key['id']}}">{{$key['school_name']}}</option>
                                 @endif
                             @else
                                 <option value="{{$key['id']}}">{{$key['subject_name']}}</option>
                             @endif
                         @endforeach
                     </select>
                 </div>
                 <div class="col-sm-6">
                     <label for="class_name" class="col-sm-4 control-label"><b>Class Name:</b></label>
                     <select name="class_name" id="class" class="form-control {{ $errors->has('class_name') ? ' is-invalid' : '' }}" required>
                         {{--@foreach($val1 as $key)
                             @if(isset($schoolsubject))
                                 @if($schoolsubject->school_id == $key['id'])
                                     <option value="{{$key['id']}}" selected>{{$key['class_name']}}</option>
                                 @else
                                     <option value="{{$key['id']}}">{{$key['class_name']}}</option>
                                 @endif
                             @else
                                 <option value="{{$key['id']}}">{{$key['class_name']}}</option>
                             @endif
                         @endforeach--}}
                     </select>
                 </div>
             </div>
            <div class="form-group">
                <br/><br/><br/>
                <label for="subject_name" class="col-sm-2 control-label"><b>Chapter Name:</b></label>
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
        </div><!-- /.box-body -->