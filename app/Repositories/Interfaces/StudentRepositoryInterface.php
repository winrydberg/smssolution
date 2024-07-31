<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface StudentRepositoryInterface
{
    public function all()                    : Collection;

    public function getStudents()            : Collection;

    public function find($id)                : Model | null;

    public function create(array $data)      : Model | null;

    public function update($id, array $data) : bool;

    public function delete($id)              :bool;

    public function searchStudents($admission_no, $student_name, $class) : Collection;

    public function generateAdmissionNo() : string;

    public function calculatePendingFees($sid) : float;

    public function getActiveStudents() : Collection;

    public function getStudentPendingFees($student_id) : Collection;

    public function createStudent(Request $request) : array;

}