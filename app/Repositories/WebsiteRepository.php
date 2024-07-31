<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\PendingPayment;
use App\Repositories\Interfaces\FeesRepositoryInterface;
use App\Repositories\Interfaces\WebsiteRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class WebsiteRepository implements WebsiteRepositoryInterface
{

    public function setActiveTemplate(Request $request) : string
    {
        return PendingPayment::where("academic_year", env("ACADEMIC_YEAR"))->sum("amount");
    }

    public function getActiveTemplate() : string
    {
        return Payment::where("academic_year", env("ACADEMIC_YEAR"))->sum("amount");
    }

}