<?php

namespace Devoogle\Src\Version\Request;

use Illuminate\Foundation\Http\FormRequest;

class StoreVersionRequest extends FormRequest
{

    use VersionRules;

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