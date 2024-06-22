<?php

namespace App\Http\Controllers;

use App\Enums\Base;
use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Repositories\ApplicationRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ApplicationRequest $request)
    {
        $jobseeker = Auth::user()->jobseeker;
        $existingApplication = $this->applicationRepo->findByJobseekerAndPostjob($jobseeker->id, $request->postjob_id);
        if ($existingApplication) {
            return redirect()->back()->with(['error' => 'Bạn đã ứng tuyển công việc này rồi.']);
        }
        if (!empty($jobseeker->resume) && !empty($jobseeker->cover_letter) && !empty($jobseeker->contact_info)) {
            $data = [
                'postjob_id'=>$request->postjob_id,
                'application_status'=>$request->application_status,
                'jobseeker_id'=>$jobseeker->id,
            ];
            $result = $this->applicationRepo->create($data);
            if ($result){
                return redirect()->back()->with(['success' => 'Apply thành công']);
            }
            return redirect()->back()->with( ['error'=>"Apply không thành công"]);
        }
        return redirect()->back()->with( ['error'=>"Apply không thành công vui lòng điền đủ thông tin cá nhân"]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Application $application
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
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $result = false;
        dd(Auth::user());
        $user = Auth::user();
        if (($user->role_id == Base::JOBSEEKER && $user->jobseeker == $application->jobseeker_id && $application->application_status == "Pending") || $user->role_id == Base::ADMIN) {
            if ($application) {
                $result = $application->delete();
            } else {
                return (['message' => 'not find application']);
            }
        }
        if ($result) {
            return (['message' => 'Application deleted successfully']);
        } else {
            return (['message' => 'Failed to delete application']);
        }
    }

    public function updateStatus(Request $request, Application $application)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'application_status' => 'required|string|in:Accepted,Rejected,Pending',
        ]);
        if ($validatedData) {
            $application->application_status = $request->application_status;
            $application->save();
            return (['message' => 'thanh cong', 'application' => $application]);
        }
    }
}
