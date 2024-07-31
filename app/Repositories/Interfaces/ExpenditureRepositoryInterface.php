<?php

namespace App\Repositories\Interfaces;

use App\Models\Expenditure;
use App\Models\ExpenditureCategory;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SebastianBergmann\Type\NullType;

interface ExpenditureRepositoryInterface
{
    public function all()  : Collection;

    public function allCategories()  : Collection;

    public function createCategory(string $name)  : ExpenditureCategory;

    public function deleteCategory(int $id) : array ;

    public function createExpenditure(Request $request)  : Expenditure;

    public function generateChartData() : array;

    public function getExpenditureReports(Request $request) : array ;

    public function getAcademicYears() : Collection;

}