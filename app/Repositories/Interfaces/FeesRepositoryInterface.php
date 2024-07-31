<?php

namespace App\Repositories\Interfaces;

 
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\NullType;

interface FeesRepositoryInterface
{
    public function all()  : Collection;

    public function getTotalPendingFees() : float;

    public function getTotalFeesCollected() : float;

    public function createFee($fee_name, $amount, $applies_on, $classes) : array;

    public function getStudentTotalPendingFees($student_id) : float;
}