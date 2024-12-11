<?php

namespace App\Livewire;

use App\Models\Barber;
use App\Models\Service;
use Livewire\Component;
use App\Models\Appointment;

class AppointmentPage extends Component
{
    public $appointments;

    // Delete-related properties
    public $confirmingAppointmentDeletion = false;
    public $appointmentToDelete = null;

    // Edit-related properties
    public $editAppointmentData = [
        'status' => 'pending',
    ];
    public $services;
    public $barbers;
    public $confirmingAppointmentEdit = false;


    // This method is called when the component is initialized
    public function mount()
    {
        $this->appointments = Appointment::all();
        $this->services = Service::all();
        $this->barbers = Barber::all();
    }

    public function editAppointment($appointmentId)
    {
        // Fetch the appointment details
        $appointment = Appointment::with(['services', 'barber'])->findOrFail($appointmentId);

        // Set the form data
        $this->editAppointmentData = [
            'id' => $appointment->id,
            'appointment_date' => $appointment->appointment_date,
            'appointment_time' => $appointment->appointment_time,
            'full_name' => $appointment->full_name,
            'phone' => $appointment->phone,
            'status' => $appointment->status,
            'service_id' => $appointment->services->first()->id ?? null,  // Assuming 1 service per appointment
            'barber_id' => $appointment->barber->id ?? null,
        ];

        // Open the modal
        $this->confirmingAppointmentEdit = true;
    }

    public function saveEditedAppointment()
    {
        $this->validate([
            'editAppointmentData.appointment_date' => 'required|date',
            'editAppointmentData.appointment_time' => 'required',
            'editAppointmentData.full_name' => 'required|string|max:255',
            'editAppointmentData.phone' => 'required|string|max:15',
            'editAppointmentData.service_id' => 'required|exists:services,id',
            'editAppointmentData.barber_id' => 'required|exists:barbers,id',
            'editAppointmentData.status' => 'required|in:pending,confirmed,canceled',
        ]);

        // Find the appointment and update it
        $appointment = Appointment::findOrFail($this->editAppointmentData['id']);
        $appointment->update([
            'appointment_date' => $this->editAppointmentData['appointment_date'],
            'appointment_time' => $this->editAppointmentData['appointment_time'],
            'full_name' => $this->editAppointmentData['full_name'],
            'phone' => $this->editAppointmentData['phone'],
            'status' => $this->editAppointmentData['status'],
        ]);

        // Sync services if necessary
        $appointment->services()->sync([$this->editAppointmentData['service_id']]);

        // Update barber
        $appointment->barber()->associate($this->editAppointmentData['barber_id']);
        $appointment->save();

        // Close the modal
        $this->confirmingAppointmentEdit = false;

        session()->flash('message', 'Appointment updated successfully!');
        $this->appointments = Appointment::all();
    }

    // This method opens the modal to confirm appointment deletion
    public function confirmDelete($appointmentId)
    {
        $this->appointmentToDelete = $appointmentId;
        $this->confirmingAppointmentDeletion = true; // Show the modal
    }

    // This method handles the actual deletion
    public function deleteAppointment()
    {
        $appointment = Appointment::find($this->appointmentToDelete);

        if ($appointment) {
            $appointment->delete();
            session()->flash('message', 'Appointment deleted successfully!');
        }

        $this->confirmingAppointmentDeletion = false; // Close the modal
        $this->appointments = Appointment::all(); // Refresh the list
    }

    // This method handles the status update
    public function updateStatus($appointmentId, $status)
    {
        $appointment = Appointment::find($appointmentId);
        if ($appointment) {
            $appointment->status = $status;
            $appointment->save();
            session()->flash('message', 'Status updated successfully!');
        }
    }



    public function render()
    {
        
        $appointments = Appointment::with(['barber', 'services'])->get();
        return view('livewire.appointment-page', compact('appointments'));
    }
}
