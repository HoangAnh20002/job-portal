<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'postjob_id' => 'required|integer',
            'application_status' => 'nullable|string|in:Accepted,Rejected,Pending',
        ];
    }

    public function messages()
    {
        return [
            'postjob_id.required' => 'Trường postjob_id không được bỏ trống.',
            'postjob_id.integer' => 'Trường postjob_id phải là số nguyên.',

            'application_status.string' => 'Trường application_status phải là một chuỗi.',
            'application_status.in' => 'Trường application_status phải là một trong các giá trị: Accepted, Rejected, Pending.',
        ];
    }
}
