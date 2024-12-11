<?php

namespace App\Livewire;

use App\Models\Barber;
use App\Models\Service;
use Livewire\Component;
use App\Models\Appointment;

class DataCard extends Component
{
    public $appointmentCount;
    public $serviceCount;
    public $barberCount;
    
    public function mount()
    {
        $this->appointmentCount = Appointment::count();
        $this->serviceCount = Service::count();
        $this->barberCount = Barber::count();
    }
    
    public function render()
    {

        return view('livewire.data-card');
    }
}
