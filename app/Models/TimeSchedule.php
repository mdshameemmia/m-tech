<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeSchedule extends Model
{
    use HasFactory;

    protected $table = 'time_schedules';
    protected $guarded  = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
