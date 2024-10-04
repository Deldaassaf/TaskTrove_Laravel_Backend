<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class categoryCount extends Model
{
    use HasFactory;
    protected $dates=['deleted_at'];
    protected $table='category_counts';
    protected $fillable=[
        'categories_id',
        'count'
    ];
    public function category(){
        return $this->belongsTo(category::class,'categories_id');
    }
}
