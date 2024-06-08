<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_title', 'job_description', 'job_requirement', 'employer_id', 'salary', 'employment_type', 'post_date', 'expiration_date', 'service_id','status',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
