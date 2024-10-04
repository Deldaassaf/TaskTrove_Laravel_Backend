<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class numberOfCompany extends Model
{
    use HasFactory;
    protected $table='number_of_companies';
    protected $fillable=[
        'numberOfCompany'
    ];
}
