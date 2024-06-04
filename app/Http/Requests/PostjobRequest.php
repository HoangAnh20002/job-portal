<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostjobRequest extends FormRequest
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
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'job_requirement' => 'required|string',
            'salary' => 'required|numeric',
            'employment_type' => 'required|in:1,2,3',
            'expiration_date' => 'required|date|after:post_date',
        ];
    }
    public function messages()
    {
        return [
            'job_title.required' => 'Tiêu đề công việc là bắt buộc.',
            'job_title.string' => 'Tiêu đề công việc phải là một chuỗi ký tự.',
            'job_title.max' => 'Tiêu đề công việc không được vượt quá 255 ký tự.',
            'job_description.required' => 'Mô tả công việc là bắt buộc.',
            'job_description.string' => 'Mô tả công việc phải là một chuỗi ký tự.',
            'job_requirement.required' => 'Yêu cầu công việc là bắt buộc.',
            'job_requirement.string' => 'Yêu cầu công việc phải là một chuỗi ký tự.',
            'salary.required' => 'Lương là bắt buộc.',
            'salary.numeric' => 'Lương phải là một số.',
            'employment_type.required' => 'Loại công việc là bắt buộc.',
            'employment_type.in' => 'Loại công việc không hợp lệ.',
            'expiration_date.required' => 'Ngày hết hạn là bắt buộc.',
            'expiration_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            'expiration_date.after' => 'Ngày hết hạn phải sau ngày đăng.',
        ];
    }
}
