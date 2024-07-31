<?php

namespace App\Repositories\Interfaces;

 
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use SebastianBergmann\Type\NullType;

interface WebsiteRepositoryInterface
{
    public function setActiveTemplate(Request $request): string;

    public function getActiveTemplate(): string ;
    
}