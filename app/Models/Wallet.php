<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = [
    	'user_id',
		'card_no',
		'ccExpiryMonth',
		'ccExpiryYear',
		'cvvNumber',
		'amount',
		'currency',
    ];
 	public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
