<?php
namespace App\Http\Requests;

use App\Enums\JobStatus;
use Illuminate\Foundation\Http\FormRequest;

class GeneralFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * Here is where you set the validation rules depending on the request.
     * 
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        if(request()->routeIs('job.create') || request()->routeIs('job.update')) {
            $rules = [
                'company_id' => 'required|lt:99999999',
                'job_title_id' => 'required|lt:99999999',
                'description' => 'required|max:20000',
                'status' => 'required|enum_key:' . JobStatus::class,
            ];
        }
        return $rules;
    }
}