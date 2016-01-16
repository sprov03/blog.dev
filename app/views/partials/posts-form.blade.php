{{-- 
        Title Input Field
 --}}
<div class="form-group">
    {{ $errors->first('title', '<span class="help-block col-sm-offset-1 ">:message</span>') }}
	{{ Form::label('title', 'Title',['class' => 'col-sm-1 control-lablel right']) }}
    <div class="col-sm-11">
    	{{ Form::text('title', null, ['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
</div>

{{--
        Body Input Field
--}}
<div class="form-group">
    {{ $errors->first('body', '<span class="help-block col-sm-offset-1">:message</span>') }}
	{{ Form::label('body', 'Body',['class' => 'col-sm-1 control-lablel right']) }}
    <div class="col-sm-11">
    	{{ Form::textarea('body',null,['class' => 'form-control','placeholder' => 'body'])}}
    </div>
</div>

{{--
        Submit Button
--}} 
<div class="form-group">
    <div class="col-sm-offset-1 col-sm-11">
    	{{ Form::submit('Submit Form',['class'=>'btn btn-default']) }}
    </div>
</div>