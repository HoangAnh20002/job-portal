<?php

namespace App\Enums;
use Illuminate\Validation\Rules\Enum;

final class Base extends Enum
{
    const ADMIN = '1';
    const EMPLOYER = '2';
    const JOBSEEKER = '3';
}
