<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employer_id', 'amount', 'payment_date', 'service_id', 'postjob_id', 'payment_status'
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function service(){

        return $this->hasOne(Service::class);
    }
}
