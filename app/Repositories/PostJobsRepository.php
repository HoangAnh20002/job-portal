<?php
namespace App\Repositories;
use App\Enums\Base;
use App\Models\Application;
use App\Models\PostJob;
use App\Repositories\Interfaces\PostJobRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PostJobsRepository extends BaseRepository implements PostJobRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getModel()
    {
        return $this->model = app()->make(PostJob::class);
    }
    public function getTotalPostJobs()
    {
        return $this->model->count();
    }
    public function updateStatus($id, $status)
    {
        $postJob = $this->model->find($id);
        $postJob->status = $status;
        $postJob->save();

        return $postJob;
    }

    public function filterStatus($status) {
        $result = $this->model->where('status',$status)->paginate(Base::PAGE);
        return $result;
    }
    public function getByServiceId($serviceId)
    {
        return $this->model->where('service_id', $serviceId)->get();
    }
    public function getlist(){
        return $this->model->where('status', 1)->orderBy('id', 'desc')->paginate(9);
    }
    public function searchTitleJob($request)
    {
        $job_title = $request->input('job_title');
        $location = $request->input('location', []);
        $salary = $request->input('salary');
        $employment_type = $request->input('employment_type');
        $industry = $request->input('industry', []);
        $current_time = Carbon::now();

        $query = $this->model->with('employer.company')
            ->where('expiration_date', '>=', $current_time);

        if (!empty($job_title)) {
            $query->whereRaw('LOWER(job_title) LIKE ?', ['%' . strtolower($job_title) . '%']);
        }

        if (!empty($location) && is_array($location)) {
            $query->whereHas('employer.company', function($q) use ($location) {
                $q->whereIn('location', $location);
            });
        }
        if (!empty($salary)) {
            switch ($salary) {
                case '0-5':
                    $query->whereBetween('salary', [0, 5000000]);
                    break;
                case '5-10':
                    $query->whereBetween('salary', [5000000, 10000000]);
                    break;
                case '10-20':
                    $query->whereBetween('salary', [10000000, 20000000]);
                    break;
                case '20+':
                    $query->where('salary', '>', 20000000);
                    break;
            }
        }
        if (!empty($employment_type)) {
            $query->where('employment_type', $employment_type);
        }

        if (!empty($industry)&& is_array($industry)) {
            $query->whereHas('employer.company', function($q) use ($industry) {
                $q->whereIn('industry', $industry);
            });
        }
        return $query->where('status', 1)
            ->orderByRaw("service_id = 2 DESC, created_at ASC")
            ->paginate(9);
    }
    public function showListPostJob()
    {
        $user = Auth::user();
        $employer = $user->employer;
        $postJobs = $employer->post_jobs()->where('status', 1)->get();

        $appliedPostJobs = $postJobs->filter(function($postJob) {
            return $postJob->applications()->exists();
        });

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $appliedPostJobs->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginatedItems = new LengthAwarePaginator($currentItems, $appliedPostJobs->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return $paginatedItems;
    }
}

