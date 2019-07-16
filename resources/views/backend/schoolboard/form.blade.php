<div class="box-body">
    <div class="form-group">

        <label for="state_board_name" class="col-sm-2 control-label">Name:</label>
        <div class="col-sm-12">
            <input type="hidden" name="id" @if(isset($SchoolboardEdit->id)) value="{{$SchoolboardEdit->id}}" @endif>
            <input type="text" id="state_board_name" name="state_board_name" class="form-control {{ $errors->has('class_name') ? ' is-invalid' : '' }}"
                   @if(isset($SchoolboardEdit))value="{{old('state_board_name') ? old('state_board_name') : ( ($SchoolboardEdit->state_board_name) ? $SchoolboardEdit->state_board_name : '' )}}"@endif >
            @if($errors->has('state_board_name'))
                <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">*{{ $errors->first('state_board_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div><!-- /.box-body -->