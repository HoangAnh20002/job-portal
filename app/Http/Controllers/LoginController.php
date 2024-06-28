<?php

namespace App\Http\Controllers;



use App\Enums\Base;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function showLoginForm()
    {
        if (Auth::check()) {
            if(Auth::user()->role_id == Base::ADMIN){
                return redirect()->intended();
            }
            if(Auth::user()->role_id == Base::EMPLOYER){
                return redirect()->intended();
            }
            return redirect()->intended();
        }
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Bạn cần nhập email.',
            'email.email' => 'Hãy nhập đúng dạng email.',
            'password.required' => 'Bạn cần nhập mật khẩu.',
            'password.min' => 'Mật khẩu cần dài ít nhất 8 kí tự.',
        ]);
        if ($this->authRepository->authenticate($request->only('email', 'password'))) {
            if(Auth::user()->role_id == Base::ADMIN){
                return redirect()->intended();
            }
            if(Auth::user()->role_id == Base::EMPLOYER){
                return redirect()->intended();
            }
            return redirect()->intended();
        }
        return redirect('login')->withInput()->withErrors([
            'email' => 'Email hoặc mật khẩu không hợp lệ'
        ]);
    }
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
        ], [
            'username.required' => 'Tên đăng nhập là bắt buộc.',
            'username.string' => 'Tên đăng nhập phải là chuỗi ký tự.',
            'username.max' => 'Tên đăng nhập không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.string' => 'Email phải là chuỗi ký tự.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'role.required' => 'Vai trò là bắt buộc.',
        ]);

        $user = $this->authRepository->registerUser($request->all());

        return redirect()->route('login')->with('success', 'Tạo tài khoản thành công');
    }

    public function logout()
    {
        Auth::logout();

        session()->flush();

        return redirect('/');
    }

}
