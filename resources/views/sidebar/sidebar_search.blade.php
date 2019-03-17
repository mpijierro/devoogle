<h2></h2>
<div class="single category hidden-xs ">
    <form action="{!! route('search-resource') !!}" method="POST" class="" role="search">
        {{ csrf_field()  }}
        <div class="input-group div-search">
            <input type="text" class="form-control"
                   placeholder="Buscar recursos de programación"
                   name="search">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"
                                                                 aria-hidden="true"></i></button>
            </div>
        </div>
    </form>

</div>