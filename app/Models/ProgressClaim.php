<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\ProgressDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgressClaim extends Model
{
    use HasFactory;
    protected $table = 'progress_claims';
    protected $guarded = [];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function progressDescription()
    {
        return $this->hasMany(ProgressDescription::class);
    }


    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

  

}
