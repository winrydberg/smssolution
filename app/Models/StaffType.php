<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffType extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    public function staffs(){
        return $this->hasMany(Staff::class, "staff_type_id");
    }
}
