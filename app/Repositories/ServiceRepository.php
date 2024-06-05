<?php
namespace App\Repositories;

use App\Models\Service;

class ServiceRepository extends BaseRepository{
    public function __construct()
    {
        parent::__construct();
    }
    public function getModel()
    {
        return $this->model = app()->make(Service::class);
    }
}   
 ?>