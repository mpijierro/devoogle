<?php

namespace Devoogle\Src\Resource\Library;

use Devoogle\Src\Tag\Model\Tag;

trait FormTaggable
{

    public function repopulateTagField($field)
    {

        if ( ! is_null(old($field))) {
            return true;
        }

        return ((isset($this->model[$field])) and ( ! empty($this->model[$field])));
    }


    public function populateTagField($field)
    {

        if ( ! is_null(old($field))) {
            return Tag::sanitizeFromInput(old($field));
        }

        if ( ! isset($this->model[$field])) {
            return '';
        }

        return $this->model[$field];

    }

}