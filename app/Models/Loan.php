<?php

namespace App\Models;

use App\Models\LoanHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;
    protected $table = 'loans';
    protected $guarded  = [];

    public function history()
    {
        return $this->hasOne(LoanHistory::class);
    }
}
