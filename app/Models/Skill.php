<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    
     protected $fillable = ['title', 'image', 'service_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
     public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
