<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccounnt extends Model
{
    use HasFactory;
    public function ReceiptAccount()
    {
        return $this->belongsTo(ReceiptAccount::class,'receipt_id');
    }


    public function PaymentAccount()
    {
        return $this->belongsTo(PaymentAccount::class,'Payment_id');
    }

    public function Single_Invoice()
    {
        return $this->belongsTo(Invoice::class,'single_invoice_id');
    }
}
