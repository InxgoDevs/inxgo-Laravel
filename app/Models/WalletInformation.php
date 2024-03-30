<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WalletInformation extends Model
{
    protected $table = 'wallet_informations';
    protected $fillable = [
        'seller_id',
        'buyer_id',
        'job_id',
        'seller_amount',
        'buyer_amount',
        'company_profit',
        'medical_charity',
        'currency',
        'is_transfer',
    ];
 	public function buyer()
    {
        return $this->belongsTo(User::class,'buyer_id','id');
    }
    public function seller()
    {
        return $this->belongsTo(User::class,'seller_id','id');
    }
}
