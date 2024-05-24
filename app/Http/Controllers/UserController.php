<?php

namespace App\Http\Controllers;

use App\Enums\Base;
use App\Models\User;
use App\Repositories\ApplicationRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployerRepositoryRepository;
use App\Repositories\JobSeekerRepositoryRepository;
use App\Repositories\PostJobsRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;
    protected $employerRepository;
    protected $jobSeekerRepository;
    protected $companyRepository;
    protected $applicationRepository;
    protected $postJobsRepository;
    public function __construct(UserRepository $userRepository, EmployerRepositoryRepository $employerRepository,
                                JobSeekerRepositoryRepository $jobSeekerRepository, CompanyRepository $companyRepository,
                                ApplicationRepository $applicationRepository, PostJobsRepository $postJobsRepository)
    {
        $this->userRepository = $userRepository;
        $this->employerRepository = $employerRepository;
        $this->jobSeekerRepository = $jobSeekerRepository;
        $this->companyRepository = $companyRepository;
        $this->applicationRepository = $applicationRepository;
        $this->postJobsRepository = $postJobsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index_ad()
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        $totalUsers = $this->userRepository->getTotalUsers();
        $totalEmployers = $this->employerRepository->getTotalEmployers();
        $totalJobSeekers = $this->jobSeekerRepository->getTotalJobSeekers();
        $totalCompanies = $this->companyRepository->getTotalCompanies();
        $totalApplications = $this->applicationRepository->getTotalApplications();
        $totalPostJobs = $this->postJobsRepository->getTotalPostJobs();
        $users = $this->userRepository->getAllUsers();
        return view('admin.adminMain',compact('role_id','users','totalUsers','totalEmployers','totalJobSeekers','totalCompanies','totalApplications','totalPostJobs'));
    }

    public function employer(){
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        $employers = $this->employerRepository->paginate(Base::PAGE);
        return view('admin.employerList.index',compact('employers','role_id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
