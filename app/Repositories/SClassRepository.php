<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Fee;
use App\Models\SClass;
use App\Models\SubClass;
use App\Repositories\Interfaces\SClassRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SClassRepository implements SClassRepositoryInterface
{
    public function all(): Collection
    {
       return SClass::all();
    }

    public function find($class_id) : SClass | null
    {
        return SClass::find($class_id);
    }

    public function subClasses(): Collection
    {
        return SubClass::all();
    }

    public function getStudents($class_id) : Collection
    {
        return Student::where('class_id', $class_id)->get();
    }


}