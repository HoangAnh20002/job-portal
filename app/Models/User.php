<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'username', 'email', 'password', 'role_id', 'avatar'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function jobSeeker()
    {
        return $this->hasOne(JobSeeker::class);
    }


}

