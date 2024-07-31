<?php

namespace App\Repositories;

use App\Models\Term;
use App\Repositories\Interfaces\TermRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TermRepository implements TermRepositoryInterface
{
    public function all(): Collection
    {
       return Term::orderBy("id", "ASC")->get();
    }

    public function getActiveTerm() : Model | null
    {
        return Term::where("active", true)->first();
    }

    public function activateTerm(Request $request): array
    {
        $term = Term::where('id', $request->id)->first();
        if($term){
           
            Term::where("id", "!=", $request->id)->update([
                "active" => false
            ]);
            $term->update(['active' => true]);
            return [
                "status" => "success",
                "message" => "Term successfully activated"
            ];
        }else{
            return [
                "status" => "error",
                "message" => "Oops, error. Unable to activate term. Please try again"
            ];
        }
    }
}