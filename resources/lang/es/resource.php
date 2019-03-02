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
            'download_exception' => 'Se ha producido un error al intentar procesar el archivo de audio. Vuelve a intentarlo o ponte en contacto con nosotros.',
            'processing' => "Se ha iniciado un proceso para obtener el audio del vídeo :title. Cuando acabe, recibirás un email con un enlace para descargar. Este 
            proceso puede durar unos minutos. Gracias por tu paciencia ;)",
            'subject' => 'Descargar audio: :title',
            'file_not_found' => 'No se ha encontrado el archivo de audio para el recurso: :title',
            'resource_not_is_youtube_video' => 'El recurso no es un vídeo de Youtube por lo que, de momento, no es posible convertirlo a audio. Disculpa las molestias, bro',
            'subject_download_exception' => 'Exception al convertir el audio de: :title'
        ]
    ]
];