<?php

namespace App\Http\Controllers;

use App\Enums\Base;
use App\Models\Service;
use App\Repositories\ApplicationRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    protected $serviceRepo;
    protected $paymentRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ServiceRepository $serviceRepo, PaymentRepository $paymentRepository)
    {
       $this->serviceRepo= $serviceRepo;
       $this->paymentRepository = $paymentRepository;
    }

    public function index(Request $request)
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        $paymentCount = $this->paymentRepository->limitServicePayment();
        $post_job = $request->postjob_id;

        $isService1Registered = $this->paymentRepository->checkServiceRegistration($post_job, 1);
        $isService2Registered = $this->paymentRepository->checkServiceRegistration($post_job, 2);

        $services = $this->serviceRepo->paginate(Base::PAGE);
        return view('service.index', compact('services', 'role_id', 'post_job', 'paymentCount', 'isService1Registered', 'isService2Registered'));
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
        $service = $service;
        return $service;
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
