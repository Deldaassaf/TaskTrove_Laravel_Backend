<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class depositOperatin extends Model
{
    use HasFactory;
    protected $table='deposit_operation';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'company_id',
        'existingAmount',

    ];

    public function company(){
        return $this->belongsTo(company::class,'portfolio_id');
    }
}
