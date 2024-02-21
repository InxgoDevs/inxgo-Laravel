<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory; 
    protected $fillable = ['title', 'image'];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
