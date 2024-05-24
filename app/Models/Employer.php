<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',  'company_id', 'contact_info'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Company::class);
    }
    public function jobs()
    {
        return $this->hasMany(Company::class);
    }
}
