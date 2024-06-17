<?php
namespace App\Repositories;
use App\Models\Employer;
use App\Repositories\Interfaces\EmployerRepositoryInterfaces;


class EmployerRepository extends BaseRepository implements EmployerRepositoryInterfaces
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getModel()
    {
        return $this->model = app()->make(Employer::class);
    }
    public function getTotalEmployers()
    {
        return $this->model->count();
    }


}
