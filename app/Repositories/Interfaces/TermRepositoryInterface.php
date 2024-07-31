<?php

namespace App\Repositories\Interfaces;

 
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SebastianBergmann\Type\NullType;

interface TermRepositoryInterface
{
    public function all()  : Collection;

    public function activateTerm(Request $request) : array;

    public function getActiveTerm(): Model | null ;
    
}