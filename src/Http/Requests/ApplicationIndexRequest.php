<?php

namespace EgeaTech\AppUpdater\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use EgeaTech\AppUpdater\Constants\BuildChannel;
use EgeaTech\AppUpdater\Dto\ApplicationsListFilters;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationsListRequestFilters;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationIndexRequestContract;

class ApplicationIndexRequest extends FormRequest implements ApplicationIndexRequestContract
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
        return [
            'build_channel' => 'nullable|string|in:'. implode(',', BuildChannel::asArray()),
        ];
    }

    public function getRequestFiltering(): ApplicationsListRequestFilters
    {
        return new ApplicationsListFilters($this->validated());
    }
}
