<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubContactCost extends Model
{
    use HasFactory;
    protected $table ='sub_contact_costs';
    protected $guarded  = [];

    public function subcontract()
    {
        return $this->belongsTo(Subcontract::class);
    }

    public function subcontractProject()
    {
        return $this->belongsTo(SubcontractProject::class);
    }

}
