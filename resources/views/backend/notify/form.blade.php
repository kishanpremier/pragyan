<div class="box-body">
    <div class="form-group">
        <div class="col-sm-12">
            <label for="title" class="col-sm-12 control-label"><b>Title:</b></label>
            <input type="hidden" name="id" @if(isset($SchoolboardEdit->id)) value="{{$SchoolboardEdit->id}}" @endif>
            <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                   @if(isset($SchoolboardEdit))value="{{old('title') ? old('title') : ( ($SchoolboardEdit->title) ? $SchoolboardEdit->title: '' )}}"@endif >
            @if($errors->has('title'))
                <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">*{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <label for="notify_image" class="col-sm-12 control-label"><b>Image:</b></label>
            <input type="file" id="notify_image" name="notify_image" onchange="validate(this)" class="form-control {{ $errors->has('notify_image') ? ' is-invalid' : '' }}"
                   @if(isset($SchoolboardEdit))value="{{old('notify_image') ? old('notify_image') : ( ($SchoolboardEdit->notify_image) ? $SchoolboardEdit->notify_image : '' )}}"@endif >
            @if($errors->has('notify_image'))
                <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">*{{ $errors->first('notify_image') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <label for="notify_description" class="col-sm-12 control-label"><b>Description:</b></label>
            <textarea id="notify_description" name="notify_description" class="form-control {{ $errors->has('notify_description') ? ' is-invalid' : '' }}">
                @if(isset($SchoolboardEdit))
                    {{$SchoolboardEdit->notify_description}}
                @endif
            </textarea>
            @if($errors->has('notify_description'))
                <span id="invalid-feedback" role="alert">
                    <strong id="error" style="color: red">*{{ $errors->first('notify_description') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div><!-- /.box-body -->