<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function category(){
        return $this->belongsTo(ExpenditureCategory::class, "expenditure_category_id");
    }

    public function term(){
        return $this->belongsTo(Term::class);
    }
}
