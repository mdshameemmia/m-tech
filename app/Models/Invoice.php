<?php

namespace App\Models;

use App\Models\Company;
use App\Models\InvoiceDetail;
use App\Models\ProgressClaim;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function progressClaim()
    {
        return $this->belongsTo(ProgressClaim::class);
    }

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class);
    }
}
