<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class numberOfJobPosted extends Model
{
    use HasFactory;
    protected $table='number_of_job_posteds';
    protected $fillable=[
        'numberOfJobPosted'
    ];
}
