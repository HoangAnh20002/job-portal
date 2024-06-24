<?php

namespace App\Http\Controllers;

use App\Enums\Base;
use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Repositories\ApplicationRepository;
use App\Repositories\PostJobsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    protected $applicationRepo;
    protected $postJobsRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ApplicationRepository $applicationRepo, PostJobsRepository $postJobsRepository)
    {
        $this->applicationRepo = $applicationRepo;
        $this->postJobsRepository = $postJobsRepository;
    }

    public function index()
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        $listPostJobs = $this->postJobsRepository->showListPostJob();
        return view('application.index',compact('listPostJobs','role_id'));
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
        if (!auth()->check()) {
            return redirect()->back()->with(['error' => 'Bạn cần đăng nhập để ứng tuyển']);
        }
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Application $application)
    {
        $result = false;
        $user = Auth::user();

        if ($user->role_id == Base::JOBSEEKER && $user->jobseeker && $user->jobseeker->id == $application->jobseeker_id && $application->application_status == "Pending") {
            $result = $application->delete();
        } elseif ($user->role_id == Base::ADMIN) {
            $result = $application->delete();
        } else {
            return back()->with('error', 'Bạn không có quyền xóa đơn ứng tuyển này.');
        }

        if ($result) {
            return back()->with('success', 'Xóa đơn ứng tuyển thành công.');
        } else {
            return back()->with('error', 'Không thể xóa đơn ứng tuyển.');
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
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
        }
        return redirect()->back()->with('error', 'Cập nhật trạng thái không thành công');
    }

    //Xewm chi tiet apply
    public function showUserApply(Request $request) {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        $postjob_id = $request->postjob_id;
        $job_title = $request->job_title;
        if($postjob_id==null){
            return redirect()->back()->with('error','Không tồn tại');
        }
        $applyUsers = $this->applicationRepo->showUserApply($postjob_id);
        return view('application.detail',compact('applyUsers','role_id','job_title'));
    }
}
