<div class="box-body">
    <div class="form-group">

        <label for="school_name" class="col-sm-2 control-label">School Name:</label>
        <div class="col-sm-12">
            <input type="hidden" name="id" @if(isset($SchoolEdit->id)) value="{{$SchoolEdit->id}}" @endif>
            <input type="text" id="school_name" name="school_name" class="form-control {{ $errors->has('school_name') ? ' is-invalid' : '' }}"
                   @if(isset($SchoolEdit))value="{{old('school_name') ? old('school_name') : ( ($SchoolEdit->school_name) ? $SchoolEdit->school_name : '' )}}"@endif required>
            @if($errors->has('school_name'))
                <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">*{{ $errors->first('school_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div><!-- /.box-body -->