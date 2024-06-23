<?php

namespace App\Http\Controllers;

use App\Enums\Base;
use App\Http\Requests\JobseekerRequest;
use App\Repositories\JobSeekerRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobSeekerController extends Controller
{
    protected $jobseekerRepository;
    protected $userRepository;

    public function __construct(JobSeekerRepository $jobSeekerRepository, UserRepository $userRepository){

        $this->jobseekerRepository = $jobSeekerRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $role_id = Auth::check() ? Auth::user()->role_id : null;
        $jobseekers = $this->jobseekerRepository->paginate(Base::PAGE);
        return view('jobseeker.index', compact('jobseekers', 'role_id'));
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
        return view('jobseeker.create',compact('role_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(JobseekerRequest $request)
    {
        $resumeFileName = null;
        if ($request->hasFile('resume')) {
            $resumeFile = $request->file('resume');
            $resumeFileName = $resumeFile->getClientOriginalName();
            $resumeFile->storeAs('resumes', $resumeFileName, 'public');
        }

        $user = $this->userRepository->create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 3,
        ]);

        $jobseeker = $this->jobseekerRepository->create([
            'user_id' => $user->id,
            'resume' => $resumeFileName,
            'cover_letter' => $request->cover_letter,
            'contact_info' => $request->contact_info,
        ]);

        return redirect()->back()->with('success', 'Tạo thành công thông tin người tìm việc.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobSeeker  $jobSeeker
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function show()
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        $user = Auth::user();
        $jobseeker = $this->jobseekerRepository->find($user->jobseeker->id);

        return view('jobseeker.jobseekerMain', compact('jobseeker','role_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobSeeker  $jobSeeker
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $role_id = null;
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
        }
        if (Auth::user()->role_id == Base::ADMIN) {
            $jobseeker = $this->jobseekerRepository->find($id);
        } elseif (Auth::user()->role_id != Base::ADMIN) {
            $jobseeker = $this->jobseekerRepository->getModel()->where('id', $id)->where('user_id', Auth::user()->id)->first();
        } else {
            $jobseeker = null;
        }
        if ($jobseeker == null) {
            return redirect()->back()->with('error', 'Bạn không có quyền truy cập.');
        }

        return view('jobseeker.edit', compact('jobseeker','role_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobSeeker  $jobSeeker
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(JobseekerRequest $request, $id)
    {
        $jobseeker = $this->jobseekerRepository->find($id);
        if (!$jobseeker) {
            return redirect()->route('jobseeker.index')->with('error', 'Người tìm việc không tồn tại.');
        }

        $user = $jobseeker->user;
        $file_name_avatar = $user->avatar;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_name_avatar = $file->getClientOriginalName();
            $file->storeAs('avatars', $file_name_avatar, 'public');
        }

        $resumeName = $jobseeker->resume;
        if ($request->hasFile('resume')) {
            if ($resumeName) {
                Storage::disk('public')->delete('resumes/' . $resumeName);
            }
            $resumeFile = $request->file('resume');
            $resumeName = time() . '_' . $resumeFile->getClientOriginalName();
            $resumeFile->storeAs('resumes', $resumeName, 'public');
        }

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'avatar' => $file_name_avatar,

        ]);

        $jobseeker->update([
            'resume' => $resumeName,
            'cover_letter' => $request->cover_letter,
            'contact_info' => $request->contact_info,
        ]);

        return redirect()->route('jobseeker.index')->with('success', 'Cập nhật thông tin người tìm việc thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobSeeker  $jobSeeker
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
            $jobseeker = $this->jobseekerRepository->find($id);

            if (!$jobseeker) {
                return redirect()->route('jobseekers.index')->with('error', 'Người tìm việc không tồn tại.');
            }
            $userId = $jobseeker->user_id;

            $this->jobseekerRepository->delete($id);

            $this->userRepository->delete($userId);

            return redirect()->route('jobseeker.index')->with('success', 'Người tìm việc đã được xóa thành công.');

    }
}
