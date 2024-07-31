<?php

namespace App\Repositories\Interfaces;

 
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\NullType;

interface AcademicRecordInterface
{
    public function recordTypes()  : Collection;
}