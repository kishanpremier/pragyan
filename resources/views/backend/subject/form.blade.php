         <div class="box-body">
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="subject_name" class="col-sm-6 control-label"><b>Subject Name:</b></label>
                    <select name="subject_name" class="form-control {{ $errors->has('subject_name') ? ' is-invalid' : '' }}">
                        @foreach($val as $key)
                            @if(isset($SchoolclassEdit->id))
                                @if($SchoolclassEdit->subject_id == $key['id'])
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
                    <label for="class_name" class="col-sm-6 control-label"><b>Name:</b></label>
                    <input type="hidden" name="id" @if(isset($SchoolclassEdit->id)) value="{{$SchoolclassEdit->id}}" @endif>
                    <input type="text" id="class_name" name="class_name" class="form-control {{ $errors->has('class_name') ? ' is-invalid' : '' }}"
                           @if(isset($SchoolclassEdit))value="{{old('class_name') ? old('class_name') : ( ($SchoolclassEdit->class_name) ? $SchoolclassEdit->class_name : '' )}}"@endif required>
                    @if($errors->has('class_name'))
                        <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">*{{ $errors->first('class_name') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div><!-- /.box-body -->