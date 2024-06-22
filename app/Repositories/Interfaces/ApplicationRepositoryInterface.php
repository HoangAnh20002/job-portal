<?php

namespace App\Repositories\Interfaces;

interface ApplicationRepositoryInterface extends BaseRepositoryInterface
{
    public function getTotalApplications();
    public function findByJobseekerAndPostjob($jobseekerId, $postjobId);
}
