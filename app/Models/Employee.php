<?php

namespace App\Models;

use App\Models\TimeSchedule;
use App\Models\StaffCPFAndSalary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';

    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function timeSchedule()
    {
        return $this->hasMany(TimeSchedule::class);
    }

    public function salaries()
    {
        return $this->hasMany(StaffCPFAndSalary::class);
    }

}
