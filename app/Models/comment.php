<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class comment extends Model
{
    use HasFactory;
    protected $table='comment';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'employe_id',
        'post_id',
        'comment'
    ];

    public function employe(){
        return $this->belongsTo('App\employe','employe_id');
    }

    public function post(){
        return $this->belongsTo('App\post','post_id');
    }
}
