<?php

namespace Mulidev\Src\Media\Repository;

use Mulidev\Src\Media\Model\Media;

class MediaRepository
{

    public function create(CreateMediaDto $dto)
    {

        return Media::create([
            'title' => $dto->getTitle(),
            'url' => $dto->getUrl(),
            'category_id' => $dto->getCategoryId(),
            'lang_id' => $dto->getLangId()
        ]);

    }

}