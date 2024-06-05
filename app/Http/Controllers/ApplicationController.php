<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Repositories\ApplicationRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApplicationController extends Controller
{
    protected $applicationRepo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ApplicationRepository $applicationRepo)
    {
        $this->applicationRepo = $applicationRepo;
    }
    public function index()
    {
        //xem tat cac application
        $application = $this->applicationRepo->all();
        return $application;
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
    public function store(ApplicationRequest $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validated();
            // Nếu dữ liệu hợp lệ, tiếp tục xử lý và lưu trữ
            $this->applicationRepo->create($validatedData);
            return ['message' => 'thanh cong'];
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    //xem Chi tiet
    public function show(Application $application)
    {
        return $application;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
        $result =  $application->delete();
        if($result){

        return (['message' => 'Application deleted successfully']);
        }
        else{
            return (['message' => 'Failed to delete application']);
        }
    }
    public function updateStatus(Request $request, Application $application)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'application_status' => 'required|string|in:Accepted,Rejected,Pending',
        ]);
        if($validatedData){
            $application->application_status = $request->application_status;
            $application->save();
            return (['message' => 'thanh cong', 'application' => $application]);
        }
    }
}
