<?php

namespace EgeaTech\AppUpdater\Http\Requests;

use EgeaTech\AppUpdater\Constants\BuildChannel;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationUpdaterRequestData;
use EgeaTech\AppUpdater\Contracts\Http\Requests\ApplicationUpdateRequestContract;
use EgeaTech\AppUpdater\Dto\ApplicationUpdateData;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationUpdateRequest extends FormRequest implements ApplicationUpdateRequestContract
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
            'name' => 'required|string',
            'build_channel' => 'required|string|in:'.implode(',', BuildChannel::asArray()),
            'build_number' => 'required|integer',
            'version' => 'required|string', // TODO: check if is a semver-valid value
            'file' => 'required|file',
        ];
    }

    public function getRequestData(): ApplicationUpdaterRequestData
    {
        return new ApplicationUpdateData($this->validated());
    }
}
