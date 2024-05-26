<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobseekerRequest extends FormRequest
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
        $rules = [
            'username' => 'required|string|max:255',
            'resume' => 'nullable|file|mimes:pdf|max:2048',
            'cover_letter' => 'nullable|string',
            'contact_info' => 'nullable|string',
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:8|max:16';
            $rules['email'] = 'required|unique:users|email|max:255';
        } else {
            $rules['password'] = 'nullable|string|min:8|max:16';
            $rules['email'] = 'required|email|max:255';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'username.required' => 'Tên là bắt buộc.',
            'username.string' => 'Tên phải là một chuỗi ký tự.',
            'username.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.string' => 'Email phải là một chuỗi ký tự.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'resume.file' => 'CV phải là một tệp.',
            'resume.mimes' => 'CV phải có định dạng PDF.',
            'resume.max' => 'Kích thước của CV không được vượt quá 2MB.',
            'cover_letter.string' => 'Lời nhắn phải là một chuỗi ký tự.',
            'contact_info.string' => 'Thông tin liên hệ phải là một chuỗi ký tự.',
        ];
    }
}
