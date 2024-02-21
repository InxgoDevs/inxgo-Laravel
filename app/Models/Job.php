<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status', 'total_price', 'client_id', 'seller_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', '=', 'active');
        // Assuming you have a 'status' column in your 'jobs' table to represent the job status
    }
    public $timestamps = false;
    protected $primaryKey = 'user_id';
}

