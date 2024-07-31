<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function fee(){
        return $this->belongsTo(Fee::class);
    }

    public function term(){
        return $this->belongsTo(Term::class);
    }
}
