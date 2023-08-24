<?php

namespace App\Models;

use App\Models\Vendor;
use App\Models\Quotation;
use App\Models\MaterialCost;
use App\Models\PaymentReceive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $guarded = [];

    public function company()
    {
        return  $this->belongsTo(Company::class,'company_id');
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    public function materialCosts()
    {
        return $this->hasMany(MaterialCost::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
    public function progressClaims()
    {
        return $this->hasMany(Quotation::class);
    }
    public function paymentReceives()
    {
        return $this->hasMany(PaymentReceive::class);
    }
}
