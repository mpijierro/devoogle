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


    protected function attachTagsWithAuthor(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        foreach ($this->tagsInArray as $tag) {

            $tagWithType = $this->createTagWithTypeAuthor($tag);

            $resource->attachTag($tagWithType);
        }

    }


    protected function attachTagsWithEvent(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        foreach ($this->tagsInArray as $tag) {

            $tagWithType = $this->createTagWithTypeEvent($tag);

            $resource->attachTag($tagWithType);
        }
    }


    protected function attachTagsWithTechnology(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        foreach ($this->tagsInArray as $tag) {

            $tagWithType = $this->createTagWithTypeTechnology($tag);

            $resource->attachTag($tagWithType);
        }
    }


    //sync

    protected function syncTags(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        $resource->syncTags($this->tagsInArray);

    }


    protected function syncTagsAuthor(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        $resource->syncTagsWithType($this->tagsInArray, Tag::TYPE_AUTHOR);

    }


    protected function syncTagsEvent(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        $resource->syncTagsWithType($this->tagsInArray, Tag::TYPE_EVENT);

    }


    protected function syncTagsTechnology(Resource $resource, string $tags)
    {

        $this->fillTagsArray($tags);

        $resource->syncTagsWithType($this->tagsInArray, Tag::TYPE_TECHNOLOGY);

    }


    private function createTagWithTypeAuthor(string $tag)
    {
        return \Spatie\Tags\Tag::findOrCreate($tag, Tag::TYPE_AUTHOR);
    }


    private function createTagWithTypeEvent(string $tag)
    {
        return \Spatie\Tags\Tag::findOrCreate($tag, Tag::TYPE_EVENT);
    }


    private function createTagWithTypeTechnology(string $tag)
    {
        return \Spatie\Tags\Tag::findOrCreate($tag, Tag::TYPE_TECHNOLOGY);
    }


    private function fillTagsArray(string $tags)
    {

        $this->tagsInArray = [];

        $tags = explode(',', $tags);

        foreach ($tags as $tag) {

            $sanitizeTag = trim(mb_strtolower($tag));

            if ( ! empty($sanitizeTag)) {
                $this->tagsInArray[] = $sanitizeTag;
            }
        }

    }

}