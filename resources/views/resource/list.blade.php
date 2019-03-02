<div class="devoogle-register alert alert-info">
    @include('resource.register_devoogle')
</div>

<!-- Modal -->
<div class="modal fade" id="modalDownloadAudio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="alert alert-info">
                    Aún no hemos convertido este vídeo en audio. Necesitamos tu dirección de correo electrónico para poder enviarte el enlace
                    de descarga una vez haya finalizado el proceso de conversión.
                    <br><br><b>Tras el envío, tu dirección de correo electrónico será eliminada del sistema</b>.
                </div>
            </div>
            <form action="#" id="modal-form-download-audio" method="post">

                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="title" style="margin-bottom:15px;">
                        <h3><i class="fa fa-download icon-register" aria-hidden="true" title="Descargar"></i> Descargar audio del vídeo </h3>
                        <span class="resource-title" id="modal-resource-title" style="color:#337ab7"></span>
                        <span ></span>
                        añadir el canal desde el que se baja
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@forelse ($resources as $resource)
    <div class="one-register">
        @include('resource.resource_register',   ['resource' => $resource])
    </div>

@empty
    <div class="row row-empty-list">
        <div class="col-xs-12">
            Este listado aún no tiene recursos para mostrar. Anímate y sé el primero en hacerlo.
        </div>
    </div>

@endforelse

@if (isset($paginator))
    <div class="row">
        <div class="col-xs-12" align="center">
            {{ $paginator }}
        </div>
    </div>
@endif