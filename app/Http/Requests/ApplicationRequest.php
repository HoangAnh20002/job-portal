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
            'jobseeker_id' => 'required|integer',
            'application_date' => 'required|date',
            'application_status' => 'nullable|string|in:Accepted,Rejected,Pending',
        ];
    }

    public function messages()
    {
        return [
            'postjob_id.required' => 'Trường postjob_id không được bỏ trống.',
            'postjob_id.integer' => 'Trường postjob_id phải là số nguyên.',
            'postjob_id.exists' => 'postjob_id không tồn tại trong cơ sở dữ liệu.',

            'jobseeker_id.required' => 'Trường jobseeker_id không được bỏ trống.',
            'jobseeker_id.integer' => 'Trường jobseeker_id phải là số nguyên.',
            'jobseeker_id.exists' => 'jobseeker_id không tồn tại trong cơ sở dữ liệu.',

            'application_date.required' => 'Trường application_date không được bỏ trống.',
            'application_date.date' => 'Trường application_date phải là một ngày hợp lệ.',

            'application_status.string' => 'Trường application_status phải là một chuỗi.',
            'application_status.in' => 'Trường application_status phải là một trong các giá trị: Accepted, Rejected, Pending.',
        ];
    }
}
