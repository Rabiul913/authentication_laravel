<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;
    protected $table = 'employee_attendances';

    protected $fillable = [
        'employee_id',
        'in_time',
        'out_time',
        'date',
    ];
    
}
