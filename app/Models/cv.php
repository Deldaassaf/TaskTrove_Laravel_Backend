<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class cv extends Model
{
    use HasFactory;
    protected $table='cv';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'employe_id',
        'name',
        'university',
        'mobileNumber',
        'email',
        'location',
        'DateOfBirth',
        'Nationality',
        'UniversityStartDate',
        'UniversityEndDate',
        'RecommendationLetter',
        'language1',
        'language2',
        'language3',
        'tecnicalSkills1',
        'tecnicalSkills2',
        'tecnicalSkills3',
        'softSkill1',
        'softSkill2',
        'softSkill3',
        'interests1',
        'interests2',
        'courses1',
        'courses2',
        'courses3',
        'AboutYou',
        'educations',
        'specialization',

    ];

    public function CV(){
        return $this->belongsTo('App\employe','employe_id');
    }
}
