<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Añadir versión en otro formato</div>

            <div class="panel-body">


                {{ Form::model($form->model(), ['url' => $form->action(), 'method'=>'POST', 'class' => 'form-horizontal']) }}

                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="url" class="col-md-4 control-label">Url</label>

                    <div class="col-md-6">
                        {{ Form::url('url', null, ['class' => 'form-control', 'id' =>'url', 'required'] ) }}

                        @if ($errors->has('url'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="category" class="col-md-4 control-label">Categoría</label>

                    <div class="col-md-6">

                        {{ \Form::select('category_id', $form->categoryOptions(), null,
                                                ['placeholder' => 'Selecciona categoría',
                                                'class' => 'form-control', 'required']) }}

                        @if ($errors->has('category'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <label for="comment" class="col-md-4 control-label">Comentario</label>

                    <div class="col-md-6">
                        {{ Form::text('comment', null, ['class' => 'form-control', 'id' =>'comment', 'autofocus'] ) }}

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
                            Crear versión
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

