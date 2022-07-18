<?php

namespace App\Http\Requests;

use App\Enums\JobStatus;
use Illuminate\Foundation\Http\FormRequest;

class JobStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => 'required|lt:99999999',
            'job_title_id' => 'required|lt:99999999',
            'description' => 'required|max:20000',
            'status' => 'required|enum_key:' . JobStatus::class,
        ];
    }
}
