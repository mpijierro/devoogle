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
            'user_must_be_logged_in' => 'La descarga que has intentado realizar no está disponible todavía. Necesitamos un email al que enviar el enlace de descarga 
            cuando la tengamos disponible. Si quieres, regístrate y vuelve a intentarlo para inicar el proceso. Disculpa las molestias, bro.',
        ]
    ]
];