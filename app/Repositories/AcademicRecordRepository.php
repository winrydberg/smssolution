<?php

namespace App\Repositories;

use App\Models\AcademicRecordType;
use App\Models\Student;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\PendingPayment;
use App\Models\StudentPayment;
use App\Repositories\Interfaces\AcademicRecordInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AcademicRecordRepository implements AcademicRecordInterface
{
   
    public function recordTypes() : Collection
    {
        return AcademicRecordType::all();
    }
}