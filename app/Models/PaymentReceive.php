<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentReceive extends Model
{
    use HasFactory;

    protected $table ='payment_receives';
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
