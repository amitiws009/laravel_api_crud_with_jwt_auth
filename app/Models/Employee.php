<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['department_id','name','dob','gender'];

     

     public function employeedetail(){
        return $this->hasMany(Employeedetail::class, 'employee_id');
    }
     public function department() {
            return $this->belongsTo('departments', 'department_id');
        }
}
