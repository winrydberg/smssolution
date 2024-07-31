<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    public function staff_class(){
        return $this->hasOne(SClass::class);
    }

    public function staff_type(){
        return $this->belongsTo(StaffType::class);
    }
}
