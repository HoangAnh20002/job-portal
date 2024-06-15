<?php

namespace App\Http\Controllers;

use App\Enums\Base;
use App\Http\Requests\PostjobRequest;
use App\Models\PostJob;
use App\Repositories\ApplicationRepository;
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
        PostJobsRepository $postJobsRepository) {
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
        if ($role_id == Base::EMPLOYER) {
            $user = Auth::user();
            $employer = $user->employer;
        }
        $post_jobs = $this->postJobsRepository->paginate(Base::PAGE);
        return view('postjob.index', compact('post_jobs', 'role_id', 'employer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        $user = Auth::user();

        $employer = $user->employer;
        $company = $employer->company;

        $employerAttributes = ['company_id', 'contact_info'];
        $companyAttributes = ['company_name', 'industry', 'description', 'location', 'website', 'phone'];

        foreach ($employerAttributes as $attribute) {
            if (empty($employer->$attribute)) {
                return redirect()->back()->with('error', 'Bạn cần hoàn thiện thông tin cá nhân trước khi tạo mới.');
            }
        }

        foreach ($companyAttributes as $attribute) {
            if (empty($company->$attribute)) {
                return redirect()->back()->with('error', 'Bạn cần hoàn thiện thông tin công ty trước khi tạo mới.');
            }
        }

        return view('postjob.create', compact('role_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostjobRequest $request)
    {
        $user = Auth::user();

        $validatedData = $request->validated();

        $validatedData['employer_id'] = $user->employer->id;
        $validatedData['post_date'] = now();
        $validatedData['service_id'] = null;
        $this->postJobsRepository->create($validatedData);

        return redirect()->route('postjob.index')->with('success', 'Bài đăng tuyển dụng đã được tạo thành công.');
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
        $role_id = Auth::user()->role_id;
        $postjob = $this->postJobsRepository->find($id);
        if (!$postjob) {
            return redirect('/postjob')->with('error', 'Không tìm thấy công việc.');
        }
        if (($postjob->employer->user_id == Auth::user()->id && $role_id == Base::EMPLOYER) || $role_id == Base::ADMIN) {
            return view('postjob.detail', compact('postjob', 'role_id'));
        }
        return redirect('/postjob')->with('error', 'Bạn không có quyền truy cập');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostJob  $job
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }

        $postjob = $this->postJobsRepository->find($id);
        if (!$postjob) {
            return redirect()->route('postjob.index')->with('error', 'Bài đăng không tồn tại.');
        }
        return view('postjob.edit', compact('postjob', 'role_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostJob  $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_status(Request $request, $id)
    {
        $status = $request->input('status');
        $postJob = $this->postJobsRepository->updateStatus($id, $status);

        return redirect()->route('postjob.show', ['postjob' => $postJob->id])
            ->with('success', 'Trạng thái bài đăng đã được cập nhật thành công.');
    }
    public function update(PostjobRequest $request, $id)
    {
        $validatedData = $request->validated();
        $this->postJobsRepository->update($id, $validatedData);

        return redirect()->route('postjob.index')->with('success', 'Bài đăng tuyển dụng đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostJob  $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $postjob = $this->postJobsRepository->find($id);
        if (!$postjob) {
            return redirect()->route('postjob.index')->with('error', 'Bài đăng không tồn tại.');
        }
        $this->postJobsRepository->delete($id);

        return redirect()->route('postjob.index')->with('success', 'Bài đăng tuyển dụng đã được xóa thành công.');
    }
    public function filterStatus(Request $request){
        $status = $request->status;
        $result = $this->postJobsRepository->filterStatus($request->status);
        return view('test',compact('result'));
    }

    public function searchTitleJob(Request $request)
    {
        $result = $this->postJobsRepository->searchTitleJob($request);
        return response()->json($result);
    }
}
