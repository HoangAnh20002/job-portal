<?php
namespace App\Repositories;

use App\Enums\Base;
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

    public function searchEmployers($content)
    {
        $lowercaseContent = strtolower($content);
        return $this->model->whereHas('user', function ($query) use ($lowercaseContent) {
            $query->whereRaw('LOWER(email) LIKE ?', ['%' . $lowercaseContent . '%'])
                ->orWhereRaw('LOWER(username) LIKE ?', ['%' . $lowercaseContent . '%'])
                ->where('role_id',2);
        })
        ->with('user') 
        ->paginate(Base::PAGE);
    }
}
