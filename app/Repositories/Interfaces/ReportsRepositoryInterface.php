<?php

namespace App\Repositories\Interfaces;

 
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SebastianBergmann\Type\NullType;

interface ReportsRepositoryInterface
{
    public function generateReport(Request $request)  : array;

    public function getAcademicYears() : Collection;

    public function generateGenderChart() : array;
}