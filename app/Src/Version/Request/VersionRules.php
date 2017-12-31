<?php

namespace Devoogle\Src\Version\Request;

trait VersionRules
{

    protected function commonMessages()
    {

        return [
            'url.required' => trans('devoogle_validation.url_required'),
            'url.url' => trans('devoogle_validation.url_url'),
            'category_id.required' => trans('devoogle_validation.category_id_required'),
            'category_id.exists' => trans('devoogle_validation.category_id_required'),
        ];


    }


    protected function commonRules()
    {
        return [
            'url' => 'required|url',
            'category_id' => 'required|exists:category,id'
        ];
    }

}