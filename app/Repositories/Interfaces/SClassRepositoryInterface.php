<?php

namespace App\Repositories\Interfaces;

 
use App\Models\Payment;
use App\Models\SClass;
use App\Models\SubClass;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\NullType;

interface SClassRepositoryInterface
{
    public function all()  : Collection;

    public function find($class_id)  : SClass | null;

    public function subClasses()  : Collection;

    public function getStudents($class_id)  : Collection;
}