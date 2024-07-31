<?php

namespace App\Repositories\Interfaces;

use App\Models\AcademicYear;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SebastianBergmann\Type\NullType;

interface AcademicYearRepositoryInterface
{
    public function all()  : Collection;

    public function getYears() : array;

    public function saveAcademicYear($year_one, $year_two) : array;

    public function activateAcademicYear($id) : array;

    public function getActiveAcademicYear() : AcademicYear | null;
    
}