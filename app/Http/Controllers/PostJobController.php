<?php

namespace App\Http\Controllers;

use App\Enums\Base;
use App\Models\PostJob;
use App\Repositories\ApplicationRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployerRepository;
use App\Repositories\PostJobsRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostJobController extends Controller
{
    protected $userRepository;
    protected $employerRepository;
    protected $applicationRepository;
    protected $postJobsRepository;
    public function __construct(UserRepository $userRepository, EmployerRepository $employerRepository,
                                ApplicationRepository $applicationRepository,
                                PostJobsRepository $postJobsRepository)
    {
        $this->userRepository = $userRepository;
        $this->employerRepository = $employerRepository;
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
        $employer = null;
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        if($role_id == Base::EMPLOYER){
            $user = Auth::user();
            $employer = $user->employer;
        }
        $post_jobs = $this->postJobsRepository->paginate(Base::PAGE);
        return view('postjob.index',compact('post_jobs','role_id','employer'));
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
     * @param  \App\Models\PostJob  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }

        $postjob = $this->postJobsRepository->find($id);
        return view('postjob.detail',compact('postjob','role_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostJob  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(PostJob $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostJob  $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_status(Request $request,$id)
    {
        $status = $request->input('status');
        $postJob = $this->postJobsRepository->updateStatus($id, $status);

        return redirect()->route('postjob.show', ['postjob' => $postJob->id])
            ->with('success', 'Trạng thái bài đăng đã được cập nhật thành công.');
    }
    public function update(Request $request, PostJob $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostJob  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostJob $job)
    {
        //
    }
}
