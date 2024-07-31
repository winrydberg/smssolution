<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    public function guardian(){
        return $this->belongsTo(Guardian::class);
    }

    public function sclass(){
        return $this->belongsTo(SClass::class, "class_id");
    }

    public function sub_class(){
        return $this->belongsTo(SubClass::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

}
