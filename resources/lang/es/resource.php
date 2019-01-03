<?php

return [

    'actions' => [
        'resource' => [
            'created_succesfully' => 'Recurso creado correctamente, gracias.',
            'updated_succesfully' => 'Recurso actualizado correctamente, gracias.',
            'deleted_succesfully' => 'Recurso eliminado correctamente, gracias.',
            'destroyed_succesfully' => 'Recurso destruído correctamente, gracias.'
        ],
        'version' => [
            'created_succesfully' => 'Versión creada correctamente, gracias.',
            'updated_succesfully' => 'Versión actualizada correctamente, gracias.',
            'deleted_succesfully' => 'Versión eliminada correctamente, gracias.',
        ],
        'download' => [
            'processing' => "Se ha iniciado un proceso para obtener el audio del vídeo :title. Cuando acabe, recibirás un email con un enlace para descargar. Este 
            proceso puede durar unos minutos. Gracias por tu paciencia ;)",
            'subject' => 'Descargar audio: :title',
            'user_must_be_logged_in' => 'Has sido la primera persona en intentar descargar este recurso por lo que aún no está disponible. Como el proceso de convertir 
            el vídeo en audio puede tardar unos minutos, necesitamos un email al que enviar el enlace de descarga una vez haya terminado dicho proceso. Por si acaso, revisa la carpeta spam de tu buzón de correo.  Disculpa las molestias, bro.',
            'resource_not_is_youtube_video' => 'El recurso no es un vídeo de Youtube por lo que, de momento, no es posible convertirlo a audio. Disculpa las molestias, bro',
            'subject_download_exception' => 'Exception al convertir el audio de: :title'
        ]
    ]
];