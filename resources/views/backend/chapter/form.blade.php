
        <div class="box-body">
             <div class="form-group">
                 <div class="col-sm-6">
                    <label for="subject_name" class="col-sm-4 control-label"><b>Subject Name:</b></label>
                     <select name="subject_name" id="subject" class="form-control {{ $errors->has('subject_name') ? ' is-invalid' : '' }}" required>
                         @foreach($val as $key)
                             @if(isset($data))
                                 @if($data->id == $key['id'])
                                     <option value="{{$key['id']}}" selected>{{$key['subject_name']}}</option>
                                 @else
                                     <option value="{{$key['id']}}">{{$key['subject_name']}}</option>
                                 @endif
                             @else
                                 <option value="{{$key['id']}}">{{$key['subject_name']}}</option>
                             @endif
                         @endforeach
                     </select>
                 </div>
                 <div class="col-sm-6">
                     <label for="class_name" class="col-sm-4 control-label"><b>Class Name:</b></label>
                     <select name="class_name" id="class" class="form-control {{ $errors->has('class_name') ? ' is-invalid' : '' }}">
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
                <label for="chapter_name" class="col-sm-2 control-label"><b>Chapter Name:</b></label>
                <div class="col-sm-12">
                    <input type="hidden" name="id" @if(isset($data->id)) value="{{$data->id}}" @endif>
                    <input type="text" id="chapter_name" name="chapter_name" class="form-control {{ $errors->has('chapter_name') ? ' is-invalid' : '' }}"
                           @if(isset($data))value="{{old('chapter_name') ? old('chapter_name') : ( ($data->chapter_name) ? $data->chapter_name : '' )}}"@endif>
                @if($errors->has('chapter_name'))
                <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">*{{ $errors->first('chapter_name') }}</strong>
                </span>
                @endif
                </div>
            </div>
        </div><!-- /.box-body -->