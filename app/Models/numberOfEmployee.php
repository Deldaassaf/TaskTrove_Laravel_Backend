<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class numberOfEmployee extends Model
{
    use HasFactory;
    protected $table='number_of_employees';
    protected $fillable=[
        'numberOfEmployee'
    ];
}
