<?php

namespace App\Models;

use App\Models\Barber;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'status',
        'appointment_date',
        'appointment_time',
        'full_name',
        'email',
        'barber_id',
        'phone'
    ];
   

    // Define the relationship with Barber model
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    // Define the relationship with Service model
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
