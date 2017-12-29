<form action="{!! route('search-resource') !!}" method="POST" class="form-horizontal" style="float:right">
    {{ csrf_field() }}

    <div class="form-group">
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