<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployerRequest extends FormRequest
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
            'contact_info' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'nullable|string|max:15',
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
            'email.unique' => 'Email này đã tồn tại.',

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',

            'contact_info.string' => 'Thông tin liên lạc phải là một chuỗi ký tự.',

            'company_name.string' => 'Tên công ty phải là một chuỗi ký tự.',
            'company_name.max' => 'Tên công ty không được vượt quá 255 ký tự.',

            'industry.string' => 'Ngành phải là một chuỗi ký tự.',
            'industry.max' => 'Ngành không được vượt quá 255 ký tự.',

            'description.string' => 'Mô tả phải là một chuỗi ký tự.',

            'location.string' => 'Vị trí phải là một chuỗi ký tự.',
            'location.max' => 'Vị trí không được vượt quá 255 ký tự.',

            'website.url' => 'Website không hợp lệ.',
            'website.max' => 'Website không được vượt quá 255 ký tự.',

            'logo.image' => 'Logo phải là một file ảnh.',
            'logo.mimes' => 'Logo phải là một trong các định dạng: jpeg, png, jpg, gif, svg.',
            'logo.max' => 'Logo không được vượt quá 2MB.',

            'phone.string' => 'Số điện thoại phải là một chuỗi ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
        ];
    }

}
