<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barber extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    // Define the relationship with Appointment model
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
