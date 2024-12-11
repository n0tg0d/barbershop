<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class ServicesPage extends Component
{
    public $services;

    // Delete a service proprties
    public $confirmingServiceDeletion = false;
    public $serviceToDelete = null;

    // Add a service properties
    public $confirmingAddService = false;
    public $newService = [
        'name' => '',
        'status' => 'available',
    ];

    // Edit Barber properties
    public $confirmingServiceEdit = false;
    public $editServiceData = [
        'id' => null,
        'name' => '',
        'status' => 'available',
    ];

    public function editService($id)
    {
        $service = Service::find($id);

        $this->editServiceData = [
            'id' => $service->id,
            'name' => $service->name,
            'status' => $service->status,
        ];

        $this->confirmingServiceEdit = true;
    }

    public function saveEditedService()
    {
        $this->validate([
            'editServiceData.name' => 'required|string|max:255',
            'editServiceData.status' => 'required|in:available,unavailable',
        ]);

        $service = Service::findOrFail($this->editBarberData['id']);
        $service->name = $this->editServiceData['name'];
        $service->status = $this->editServiceData['status'];
        $service->save();

        $this->confirmingServiceEdit = false;
        session()->flash('message', 'Barber updated successfully.');
        $this->services = Service::orderBy('created_at', 'desc')->get();
    }

    // Svae New Service
    public function saveNewService()
    {
        $this->validate([
            'newService.name' => 'required|string|max:255',
            'newService.status' => 'required|in:available,unavailable',
        ]);

        Service::create([
            'name' => $this->newService['name'],
            'status' => $this->newService['status'],
        ]);

        // Reset the data and close the modal
        $this->reset('newService');
        $this->confirmingAddService = false;

        session()->flash('message', 'Service added successfully!');
        $this->services = Service::all();
    }

    // This method opens the modal to confirm service  deletion
    public function confirmDelete($serviceId)
    {
        $this->serviceToDelete = $serviceId;
        $this->confirmingServiceDeletion = true; // Show the modal
    }

    // This method handles the actual deletion
    public function deleteService()
    {
        $service = Service::find($this->serviceToDelete);

        if ($service) {
            $service->delete();
            session()->flash('message', 'Appointment deleted successfully!');
        }

        $this->confirmingServiceDeletion = false; // Close the modal
        $this->services = Service::all(); // Refresh the list
    }

    // This method handles the status update
    public function updateStatus($serviceId, $status)
    {
        $service = Service::find($serviceId);

        if (!$service) {
            session()->flash('error', 'Barber not found!');
            return;
        }

        if (!in_array($status, ['available', 'unavailable'])) {
            session()->flash('error', 'Invalid status value!');
            return;
        }

        $service->status = $status;
        $service->save();

        session()->flash('message', 'Status updated successfully!');
        $this->services = Service::all();
    }

    public function mount()
    {
        $this->services = Service::orderBy('created_at', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.services-page');
    }
}
