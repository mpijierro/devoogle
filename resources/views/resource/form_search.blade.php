<form action="{!! route('search-resource') !!}" method="POST" class="form-horizontal">
    {{ csrf_field() }}


    <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
        <label for="search" class="col-md-4 control-label">Búsqueda</label>

        <div class="col-md-6">
            {{ Form::text('search', null, ['class' => 'form-control', 'id' =>'search', 'required', 'autofocus'] ) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Buscar
            </button>
        </div>
    </div>

</form>