<?php

namespace Devoogle\Src\Resource\Request;


trait ResourceRules
{

    protected function commonMessages()
    {

        return [
            'url.required' => trans('devoogle_validation.resource.url_required'),
            'title.required' => trans('devoogle_validation.resource.title_required'),
            'category_id.required' => trans('devoogle_validation.resource.category_id_required'),
            'category_id.exists' => trans('devoogle_validation.resource.category_id_required'),
            'lang_id.required' => trans('devoogle_validation.resource.lang_id_required'),
            'lang_id.exists' => trans('devoogle_validation.resource.lang_id_required')
        ];

    }


    protected function commonRules()
    {

        return [
            'title' => 'required',
            'url' => 'required|url',
            'category_id' => 'required|exists:category,id',
            'lang_id' => 'required|exists:lang,id'
        ];
    }

}