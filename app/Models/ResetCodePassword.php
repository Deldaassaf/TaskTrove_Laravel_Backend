<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetCodePassword extends Model
{
    use HasFactory;
    protected $table='reset_code_passwords';
    protected $fillable = [
        'email',
        'code',
        'created_at',
    ];
}
