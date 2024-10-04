<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;
    protected $table='admins';
    protected $fillable=[
        'user_id',
        'username'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
