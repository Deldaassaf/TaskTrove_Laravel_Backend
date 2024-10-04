<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Applicants extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table='_applicants';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'job_id',
        'employe_id',
        'file'
    ];
    public function job(){
        return $this->belongsTo('App\job','job_id');
    }

    public function employe(){
        return $this->belongsTo('App\Models\employe','employe_id');
    }
}
