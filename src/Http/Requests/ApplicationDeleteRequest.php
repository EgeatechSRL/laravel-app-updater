<?php

namespace EgeaTech\AppUpdater\Http\Requests;

use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationDeleteRequestContract;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationDeleteRequest extends FormRequest implements ApplicationDeleteRequestContract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
