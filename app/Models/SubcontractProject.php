<?php

namespace App\Models;

use App\Models\Subcontract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubcontractProject extends Model
{
    use HasFactory;

    protected $table = 'subcontract_projects';
    protected $guarded = [];

    public function subcontract()
    {
        return $this->belongsTo(Subcontract::class);
    }

    public function subcontractCost()
    {
        return $this->belongsTo(SubContactCost::class);
    }

}
