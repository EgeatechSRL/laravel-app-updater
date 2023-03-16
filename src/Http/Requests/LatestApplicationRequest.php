<?php

namespace EgeaTech\AppUpdater\Http\Requests;

use EgeaTech\AppUpdater\Constants\BuildChannel;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationsListRequestFilters;
use EgeaTech\AppUpdater\Contracts\Http\Requests\LatestApplicationRequestContract;
use EgeaTech\AppUpdater\Dto\ApplicationsListFilters;
use Illuminate\Foundation\Http\FormRequest;

class LatestApplicationRequest extends FormRequest implements LatestApplicationRequestContract
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
            'build_channel' => 'required|string|in:'.implode(',', BuildChannel::asArray()),
        ];
    }

    public function getRequestFiltering(): ApplicationsListRequestFilters
    {
        return new ApplicationsListFilters($this->validated());
    }
}
