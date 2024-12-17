<?php

namespace App\Livewire;

use App\Models\Barber;
use App\Models\Service;
use Livewire\Component;
use App\Models\Appointment;

class AppointmentForm extends Component
{

    public $showModal = false;
    protected $listeners = ['showAppointmentModal' => 'showModal'];

    public $services;
    public $barbers;
    public $date;
    public $time;
    public $full_name;
    public $email;
    public $phone;
    public $service_id;
    public $barber_id;

    public function mount()
    {
        // Fetch only available services and barbers
        $this->services = Service::where('status', 'available')->get();
        $this->barbers = Barber::where('status', 'available')->get();
    }

    public function showModal()
    {
        $this->showModal = true;
    }
    public function hideModal()
    {
        $this->showModal = false;
    }

    public function submitAppointment()
    {
        $validatedData = $this->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'barber_id' => 'required|exists:barbers,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);
        // dd($validatedData);

        Appointment::create([
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'service_id' => $this->service_id,
            'barber_id' => $this->barber_id,
            'appointment_date' => \Carbon\Carbon::parse($this->date)->toDateString(),
            'appointment_time' => $this->time,
        ]);

        session()->flash('message', 'Appointment booked successfully!');

        $this->resetForm();
        $this->hideModal();
    }
    public function resetForm()
    {
        $this->full_name = '';
        $this->email = '';
        $this->phone = '';
        $this->service_id = '';
        $this->barber_id = '';
        $this->date = '';
        $this->time = '';
    }

    public function render()
    {
        return view('livewire.appointment-form');
    }
}
