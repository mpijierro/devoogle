<?php

namespace Mulidev\Src\Resource\Repository;

use Mulidev\Src\Resource\Model\Resource;
use Mulidev\Src\Resource\Model\ResourceHome;

class ResourceRepository
{

    public function resourceForHome()
    {

        return Resource::with(['category', 'lang'])->orderBy('created_at', 'desc')->get();

    }


    public function create(CreateResourceDto $dto)
    {

        return Resource::create([
            'title' => $dto->getTitle(),
            'description' => $dto->getDescription(),
            'url' => $dto->getUrl(),
            'category_id' => $dto->getCategoryId(),
            'lang_id' => $dto->getLangId()
        ]);

    }

}