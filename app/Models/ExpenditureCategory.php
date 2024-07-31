<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureCategory extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function expenditures(){
        return $this->hasMany(Expenditure::class);
    }
}
