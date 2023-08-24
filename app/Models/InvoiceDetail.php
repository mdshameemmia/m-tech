<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $table = 'invoice_details';
    protected $guarded = [];
    public function invoice()
    {
        return $this->belongsTo(Insvoice::class);
    }
}
