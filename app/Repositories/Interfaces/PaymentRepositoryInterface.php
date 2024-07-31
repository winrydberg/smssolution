<?php

namespace App\Repositories\Interfaces;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface PaymentRepositoryInterface
{
    public function all() : Collection;

    public function getLatest() : Collection;

    public function find($id) : Payment | null;

    public function create(array $data) : Payment | null;

    public function update($id, array $data) : bool;

    public function delete($id) : bool;

    public function savePaymentInfo(Request $request) : array;

    public function calculateThisTermFees() : float;
    
    public function searchPayments(Request $request) : Collection;

    public function generateInvoice($student_id, $gtype, $fees) : array;
    
}