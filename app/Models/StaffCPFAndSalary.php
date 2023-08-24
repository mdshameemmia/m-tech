<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffCPFAndSalary extends Model
{
    use HasFactory;
    protected $table ='staff_cpf_and_salaries';
    protected $guarded =[];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
