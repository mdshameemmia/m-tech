<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Levy extends Model
{
    use HasFactory ,LogsActivity;
    protected $table ='levies';
    protected $guarded = [];
    protected static $recordEvents = ['created','updated','deleted'];

}
