<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeedetail extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id','address_1','address_2','mobile','email'];

    public function employee() {
            return $this->belongsTo('employee', 'employee_id');
        }

}
