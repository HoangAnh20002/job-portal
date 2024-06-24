<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'postjob_id', 'jobseeker_id', 'application_status'
    ];

    public function postjob()
    {
        return $this->belongsTo(PostJob::class,'postjob_id');
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'jobseeker_id');
    }
}
