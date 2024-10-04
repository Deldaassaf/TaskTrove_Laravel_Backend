<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class post extends Model
{
    use HasFactory;

    protected $table='_post';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'employe_id',
        'Post',
        'image'
    ];

    public function employe(){
        return $this->belongsTo('App\employe','employe_id');
    }
}
