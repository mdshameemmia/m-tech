<?php

namespace App\Models;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanHistory extends Model
{
    use HasFactory;
    protected $table ='loan_histories';
    protected $guarded = [];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
