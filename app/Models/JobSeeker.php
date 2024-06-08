<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobSeeker extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'resume', 'cover_letter', 'contact_info'
    ];

    public function user() //????
    {
        return $this->belongsTo(User::class);
    }
    public function post_jobs()
    {
        return $this->belongsToMany(PostJob::class,'applications','postjob_id','jobseeker_id');
    }
}
