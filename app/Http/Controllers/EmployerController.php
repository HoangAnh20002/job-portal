<?php

namespace App\Http\Controllers;

use App\Enums\Base;
use App\Http\Requests\EmployerRequest;
use App\Models\Employer;
use App\Repositories\ApplicationRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployerRepository;
use App\Repositories\PostJobsRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    protected $userRepository;
    protected $employerRepository;
    protected $companyRepository;
    protected $applicationRepository;
    protected $postJobsRepository;
    public function __construct(UserRepository $userRepository, EmployerRepository $employerRepository,
        CompanyRepository $companyRepository, ApplicationRepository $applicationRepository,
        PostJobsRepository $postJobsRepository) {
        $this->userRepository = $userRepository;
        $this->employerRepository = $employerRepository;
        $this->companyRepository = $companyRepository;
        $this->applicationRepository = $applicationRepository;
        $this->postJobsRepository = $postJobsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        $employers = $this->employerRepository->paginate(Base::PAGE);
        return view('employer.index', compact('employers', 'role_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        return view('employer.create', compact('role_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmployerRequest $request)
    {
        $file_name_avatar = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_name_avatar = $file->getClientOriginalName();
            $file->storeAs('avatars', $file_name_avatar, 'public');
        }

        $file_name_logo = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file_name_logo = $file->getClientOriginalName();
            $file->storeAs('logos', $file_name_logo, 'public');
        }

        $user = $this->userRepository->create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => $file_name_avatar,
            'role_id' => 2,
        ]);

        $company = $this->companyRepository->create([
            'company_name' => $request->company_name,
            'industry' => $request->industry,
            'description' => $request->description,
            'location' => $request->location,
            'website' => $request->website,
            'logo' => $file_name_logo,
            'phone' => $request->phone,
        ]);

        $this->employerRepository->create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'contact_info' => $request->contact_info,
        ]);
        return redirect()->back()->with('success', 'tạo thành công thông tin nhà tuyển dụng');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Employer $employer)
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        $user = Auth::user();
        $employer = $this->employerRepository->find($user->employer->id);
        return view('employer.employerMain', compact('role_id', 'employer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        if (Auth::user()->role_id == Base::ADMIN) {
            $employer = $this->employerRepository->find($id);
        } elseif (Auth::user()->role_id != Base::ADMIN) {
            $employer = $this->employerRepository->getModel()->where('id', $id)->where('user_id', Auth::user()->id)->first();

        } else {
            $employer = null;
        }
        if ($employer == null) {
            return redirect()->route('employer.index')->with('error', 'Không tìm thấy nhà tuyển dụng.');
        }

        return view('employer.edit', compact('employer', 'role_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EmployerRequest $request, $id)
    {
        $employer = $this->employerRepository->find($id);
        if (!$employer) {
            return redirect()->route('employer.index')->with('error', 'Không tìm thấy nhà tuyển dụng.');
        }
        $user = $employer->user;
        $company = $employer->company;

        $file_name_avatar = $user->avatar;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_name_avatar = $file->getClientOriginalName();
            $file->storeAs('avatars', $file_name_avatar, 'public');
        }

        $file_name_logo = $company->logo;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file_name_logo = $file->getClientOriginalName();
            $file->storeAs('logos', $file_name_logo, 'public');
        }

        $userData = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => $user->password,
            'avatar' => $file_name_avatar,
        ];

        if ($request->password) {
            $userData['password'] = bcrypt($request->password);
        }

        $this->userRepository->update($user->id, $userData);

        $this->companyRepository->update($company->id, [
            'company_name' => $request->company_name,
            'industry' => $request->industry,
            'description' => $request->description,
            'location' => $request->location,
            'website' => $request->website,
            'logo' => $file_name_logo,
            'phone' => $request->phone,
        ]);

        $this->employerRepository->update($id, [
            'contact_info' => $request->contact_info,
        ]);

        return redirect()->route('employer.index')->with('success', 'Cập nhập thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $employer = $this->employerRepository->find($id);
        if (!$employer) {
            return redirect()->route('employer.index')->with('error', 'Không tìm thấy nhà tuyển dụng.');
        }
        $this->userRepository->delete($employer->user_id);

        $this->companyRepository->delete($employer->company_id);

        $this->employerRepository->delete($id);

        return redirect()->route('employer.index')->with('success', 'Đã xóa thành công');
    }
}
