<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suggested_freind extends Model
{
    use HasFactory;
    protected $table='suggested_freinds';
    protected $fillable=[
        'employe_id'
    ];

    public function user(){
        return $this->belongsTo(employe::class,'employe_id');
    }

    
}
