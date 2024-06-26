<?php

namespace App\Http\Controllers\interface;

use App\Enums\Base;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\CompanyRepository;
use App\Repositories\PostJobsRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $userRepository;
    protected $postJobsRepository;
    protected $companyRepository;

    public function __construct(UserRepository $userRepository,
                                PostJobsRepository $postJobsRepository,CompanyRepository $companyRepository)
    {
        $this->userRepository = $userRepository;
        $this->postJobsRepository = $postJobsRepository;
        $this->companyRepository = $companyRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $role_id = null;
        if (auth()->check()) {
            $role_id = auth()->user()->role_id;
        }

        $postJobsWithFirstService = $this->postJobsRepository->getByServiceId(1);
        $companies = $this->companyRepository->all();
        $backgroundImages = ['bg1.jpg', 'bg2.jpg', 'bg3.jpg', 'bg4.jpg', 'bg5.jpg'];
        $postJobs = $this->postJobsRepository->getlist();

        $locations = $companies->pluck('location')->unique();
        $industries = $companies->pluck('industry')->unique();

        return view('interface.welcome', compact('role_id', 'postJobsWithFirstService', 'backgroundImages', 'companies', 'postJobs', 'locations', 'industries'));
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
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
