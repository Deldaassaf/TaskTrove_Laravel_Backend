<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class portfolio extends Model
{
    use HasFactory;
    protected $table='_portfolio';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'depositOperation_id',
        'amount',
        'operationType',
        'cardId',
        'expirationDate',
        'CVVcode',
        'cardUser',
        'bankName',
        'accountId',
        'transferDate',

    ];
    public function depositOperatin(){
        return $this->belongsTo(depositOperatin::class,'depositOperation_id');
    }


}
