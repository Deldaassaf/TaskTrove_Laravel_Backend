<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freind extends Model
{
    use HasFactory;
    protected $table='freinds';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'employe_id',
        'suggested_freind_id'

    ];
    public function employe(){
        return $this->belongsTo('App\employe','employe_id');
    }

    public function suggested_freind(){
        return $this->belongsTo('App\suggested_freind','suggested_freind_id');
    }
}
