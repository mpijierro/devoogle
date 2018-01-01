<div class="form-group{{ $errors->has($key) ? ' has-error' : '' }}">
    <label for="event" class="col-md-4 control-label">{{$title}}</label>

    <div class="col-md-6">
        {{ Form::textarea($key, null, ['class' => '', 'style'=>'border:1px solid #ccd0d2; border-radius:4px', 'id' =>$key, 'autofocus', 'rows'=>2] ) }}

        @if ($errors->has($key))
            <span class="help-block">
                                        <strong>{{ $errors->first($key) }}</strong>
                                    </span>
        @endif
    </div>
</div>