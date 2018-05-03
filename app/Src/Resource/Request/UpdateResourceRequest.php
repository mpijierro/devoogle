<?php

namespace Devoogle\Src\Resource\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResourceRequest extends FormRequest
{

    use ResourceRules;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function messages()
    {
        return $this->commonMessages();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->commonRules();
    }
}