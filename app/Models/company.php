<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class company extends Model
{
    use HasFactory;
    protected $table='_company';
    protected $fillable=[
        'user_id',
        'companyName',
        'profileImage',
        'companyAbout',
        'companyLocation',
        'NumberOfEmployees'

    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function depositOperatio(){
        return $this ->hasOne(depositOperatio::class);
    }
}
