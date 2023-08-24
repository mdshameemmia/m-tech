<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\ProgressClaim;
use App\Models\SalaryVouchar;
use App\Models\PaymentReceive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    protected $table ='company';
    protected $guarded = [];

    public function employess()
    {
        return $this->hasMany(Employee::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function   quotation()
    {
        return $this->hasOne(Quotation::class);
    }

    public function progressClaim()
    {
        return $this->belongsTo(ProgressClaim::class);
    }

    
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function paymentReceive()
    {
        return $this->hasMany(PaymentReceive::class);
    }

    
    public function salaryVouchars()
    {
        return $this->hasMany(SalaryVouchar::class);
    }


    
}
