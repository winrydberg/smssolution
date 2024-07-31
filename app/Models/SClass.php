<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="classes";

    protected $guarded = ["id"];

    public function students(){
        return $this->hasMany(Student::class, "class_id");
    }

    public function class_subcategories(){
        return $this->belongsToMany(SubClass::class, "class_sub_category", "class_id", "sub_class_id");
    }
}
