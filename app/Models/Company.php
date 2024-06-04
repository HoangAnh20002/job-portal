<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name', 'industry', 'description', 'location', 'website', 'phone', 'logo'
    ];
    public function employer()
    {
        return $this->hasOne(Employer::class);
    }
}
