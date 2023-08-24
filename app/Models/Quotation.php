<?php

namespace App\Models;

use Mpdf\Tag\Progress;
use App\Models\Company;
use App\Models\Project;
use App\Models\ProgressClaim;
use App\Models\ProductQuotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;
    protected $table = 'quotations';
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    public function productQuotations()
    {
        return $this->hasMany(ProductQuotation::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function progressClaim()
    {
        return $this->hasMany(ProgressClaim::class);
    }

}
