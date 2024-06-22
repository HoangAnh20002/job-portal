<?php
namespace App\Repositories;
use App\Models\Application;
use App\Models\PostJob;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class ApplicationRepository extends BaseRepository implements ApplicationRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getModel()
    {
        return $this->model = app()->make(Application::class);
    }
    public function getTotalApplications()
    {
        return $this->model->count();
    }
    public function showUserApply($postjob_id){
        $user = Auth::user();
        $employer_id = $user->employer->id;
        $postJobs=  PostJob::where('employer_id',$employer_id)->where('id',$postjob_id)->first();
        if($postJobs!=null){
            $applications = $this->model->with(['jobSeeker'])->where('postjob_id',$postJobs->id)->get();
            return $applications;
        }
        return redirect()->back()->with('error','Không tồn tại');

    }
}
