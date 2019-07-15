 <div class="box-body">
            <div class="form-group">
                  
                <label for="class_name" class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-12">
                    
                       <input type="hidden" name="id" value="{{$SchoolclassEdit->id}}">
                <input type="text" id="class_name" name="class_name" class="form-control {{ $errors->has('class_name') ? ' is-invalid' : '' }}"
                       value="{{old('class_name') ? old('class_name') : ( ($SchoolclassEdit->class_name) ? $SchoolclassEdit->class_name : '' )}}">
                @if ($errors->has('class_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('class_name') }}</strong>
                </span>
                @endif
                    
                </div>
            </div>

        </div><!-- /.box-body -->