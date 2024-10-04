<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class job extends Model
{
    use HasFactory;
    protected $table='_job';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'company_id',
        'jobName',
        'jobSpecialization',
        'jobLocation',
        'jobDiscription',
        'jobRequirements',
        'jobHours',
        'jobSalary',
        'jobExperience',
        'category'
    ];
    public function company(){
        return $this->belongsTo('App\company','company_id');
    }
    public function payments(){
        return $this ->hasOne(payments::class);
    }

}

