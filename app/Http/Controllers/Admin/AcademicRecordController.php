<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AcademicRecordInterface;

class AcademicRecordController extends Controller
{
    
    public function __construct(AcademicRecordInterface $academicRecordRepo)
    {
        
    }
    public function recordTypes(){
        return view('admin.academic_record.record_types');
    }
}
