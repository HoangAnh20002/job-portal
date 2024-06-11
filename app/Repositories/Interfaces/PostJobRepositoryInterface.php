<?php

namespace App\Repositories\Interfaces;

interface PostJobRepositoryInterface extends BaseRepositoryInterface
{
    public function getTotalPostJobs();
    public function updateStatus($id, $status);
    public function getByServiceId($serviceId);

}
