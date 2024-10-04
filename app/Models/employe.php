<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employe extends Model
{
    use HasFactory;
    protected $table='_employe';
    protected $fillable=[
        'user_id',
        'employeeName',
        'location',
        'profileImage',
        'employeeSpecialization',
        'employeeAcademicStatus',
        'yearsOfExperience',
        'expectedSalary',
        'employeeComunnicationTool'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function suggested_freind(){
        return $this ->hasOne(suggested_freind::class);
    }
}
