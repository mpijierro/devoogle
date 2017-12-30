<?php

namespace Devoogle\Src\Resource\Model;

use Devoogle\Src\Tag\Model\Tag;

trait Taggable
{

    private $tagsInArray = [];

    protected function attachTags(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        foreach ($this->tagsInArray as $tag) {
            $resource->attachTag($tag);
        }
    }

    private function fillTagsArray(string $tags)
    {

        $this->tagsInArray = [];

        $tags = explode(',', $tags);

        foreach ($tags as $tag) {

            $sanitizeTag = trim($tag);

            if ( ! empty($sanitizeTag)) {
                $this->tagsInArray[] = $sanitizeTag;
            }
        }

    }

    protected function syncTags(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        $resource->syncTags($this->tagsInArray);

    }

    protected function attachTagsWithAuthor(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        foreach ($this->tagsInArray as $tag) {

            $tagWithType = $this->createTagWithType($tag);

            $resource->attachTag($tagWithType);
        }

    }

    private function createTagWithType(string $tag)
    {
        return \Spatie\Tags\Tag::findOrCreate($tag, Tag::TYPE_AUTHOR);
    }

    protected function syncTagsAuthor(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        $resource->syncTagsWithType($this->tagsInArray, Tag::TYPE_AUTHOR);

    }

}