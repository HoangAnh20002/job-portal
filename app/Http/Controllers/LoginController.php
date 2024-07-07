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
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
        ]);
        if ($this->authRepository->authenticate($request->only('email', 'password'))) {
            $user = Auth::user();
            session([
                'auth'=>$user
            ]);
            if(Auth::user()->role_id == Base::ADMIN){
                return redirect()->intended();
            }
            if(Auth::user()->role_id == Base::EMPLOYER){
                return redirect()->intended();
            }
            return redirect()->intended();
        }
        return redirect('login')->withInput()->withErrors([
            'email' => 'Invalid email or password.'
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
        ]);

        $user = $this->authRepository->registerUser($request->all());

        return redirect()->route('login')->with('success', 'Tạo tài khoản thành công');
    }
    public function logout()
    {
        // Đăng xuất người dùng
        Auth::logout();
        
        // Xoá tất cả dữ liệu trong session
        session()->flush();

        // Chuyển hướng người dùng về trang chủ
        return redirect('/');
    }

}
