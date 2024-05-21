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
        return view('auth.login');
    }
    public function login(Request $request)
    {
        if ($this->authRepository->authenticate($request->only('email', 'password'))) {
            if(Auth::user()->role_id == Base::ADMIN){
                return redirect('adminMain');
            }
            if(Auth::user()->role_id == Base::EMPLOYER){
                return redirect('employerMain');
            }
            return redirect('jobSeekerMain');
        }
        return redirect('login')->withInput()->withErrors([
            'email' => 'Invalid email or password.'
        ]);
    }
}
