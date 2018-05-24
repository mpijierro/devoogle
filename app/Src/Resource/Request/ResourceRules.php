<?php

namespace Devoogle\Src\Resource\Request;

trait ResourceRules
{

    protected function commonMessages()
    {

        return [
            'url.required' => trans('devoogle_validation.url_required'),
            'url.url' => trans('devoogle_validation.url_url'),
            'title.required' => trans('devoogle_validation.title_required'),
            'category_id.required' => trans('devoogle_validation.category_id_required'),
            'category_id.exists' => trans('devoogle_validation.category_id_required'),
        ];

    }


    protected function commonRules()
    {

        return [
            'title' => 'required',
            'url' => 'required|url',
            'category_id' => 'required|exists:category,id',
        ];
    }

}