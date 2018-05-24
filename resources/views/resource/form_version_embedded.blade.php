<div class="panel panel-default">
    <div class="panel-heading">{!! isset($formTitle)?$formTitle:'Añadir nuevo formato' !!}</div>

    <div class="panel-body">


        {{ Form::model($form->model(), ['url' => $form->action(), 'method'=>'POST', 'class' => 'form-horizontal']) }}

        <div class="form-group info-form">
            <label for="" class="col-md-4 control-label"></label>
            <div class="col-md-6">
                <i class="fa fa-info-circle" aria-hidden="true"></i> Si <b>{!! $resource->title() !!}</b> está en otro
                formato puedes
                indicarlo a continuación.
            </div>
        </div>

        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
            <label for="url" class="col-md-4 control-label">Url</label>

            <div class="col-md-6">
                {{ Form::url('url', null, ['class' => 'form-control', 'id' =>'url', 'autofocus', 'required1'] ) }}

                @if ($errors->has('url'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
            <label for="category" class="col-md-4 control-label">Formato</label>

            <div class="col-md-6">

                {{ \Form::select('category_id', $form->categoryOptions(), null,
                                        ['placeholder' => 'Selecciona formato',
                                        'class' => 'form-control', 'required1']) }}

                @if ($errors->has('category_id'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
            <label for="comment" class="col-md-4 control-label">Descripción</label>

            <div class="col-md-6">
                {{ Form::textarea('comment', null, ['class' => 'form-control', 'id' =>'comment', 'rows'=>2] ) }}

                @if ($errors->has('comment'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    {!! isset($textButton)?$textButton:'Añadir' !!}
                </button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>


