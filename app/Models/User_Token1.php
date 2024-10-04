<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class User_Token1 extends Model
{
    use HasFactory;

    protected $table='user__token1s';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'user_id',
        'user_token'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
