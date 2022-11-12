<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeContact extends Model
{
    use HasFactory;
    protected $table = 'employee_contacts';
    
    protected $fillable = [
        'employee_id',
        'contact_name',
        'contact_email',
        'contact_phone',
    ];
}
