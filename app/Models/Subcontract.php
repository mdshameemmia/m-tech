<?php

namespace App\Models;

use App\Models\SubContactCost;
use App\Models\SubcontractProject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcontract extends Model
{
    use HasFactory;

    protected $table ='subcontracts';
    protected $guarded = [];

    public function subcontractProjects()
    {
        return $this->hasMany(SubcontractProject::class);
    }

    public function subcontractCosts()
    {
        return $this->hasMany(SubContactCost::class);
    }

}
