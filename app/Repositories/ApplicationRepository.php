<?php
namespace App\Repositories;
use App\Models\Application;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;


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
    public function findByJobseekerAndPostjob($jobseekerId, $postjobId)
    {
        return $this->model->where('jobseeker_id', $jobseekerId)
            ->where('postjob_id', $postjobId)
            ->first();
    }

}
