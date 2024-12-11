<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];

    // Define the relationship with Appointment model
    public function appointments()
    {
        return $this->belongsToMany(Appointment::class);
    }
}
