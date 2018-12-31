<!DOCTYPE html>
<html>
<head>
    <title>Devoogle - Descargar audio</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
</head>

<body>
<h2>Audio disponible</h2>
<br/>
Hola, ya tienes disponible el audio para descargar desde el siguiente enlace: <br><br>

<a class="btn btn-info" href="{!! route(\Devoogle\Src\Devoogle\Library\Route::ROUTE_NAME_DOWNLOAD_AUDIO, $resource->slug()) !!}">Descargar <b>{!! $resource->title() !!}</b></a>
</body>

</html>