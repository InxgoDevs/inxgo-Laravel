<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolio extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        // Add other fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
