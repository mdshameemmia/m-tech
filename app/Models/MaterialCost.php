<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialCost extends Model
{
    use HasFactory, LogsActivity;
    protected $table ='material_costs';
    protected $guarded =[];
    protected static $recordEvents = ['created','updated'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
