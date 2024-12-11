<?php

namespace App\Livewire;

use App\Models\Barber;
use App\Models\Service;
use Livewire\Component;

class BarberPage extends Component
{

    public $barbers;

    // Delete Barber properties
    public $confirmingBarberDeletion = false;
    public $barberToDelete = null;

    // Add Barber properties
    public $confirmingAddBarber = false;
    public $newBarber = [
        'name' => '',
        'status' => '',
    ];

    // Edit Barber properties
    public $confirmingBarberEdit = false;
    public $editBarberData = [
        'id' => null,
        'name' => '',
        'status' => 'available',
    ];

    public function mount()
    {
        $this->barbers = Barber::orderBy('created_at', 'desc')->get();
    }

    public function editBarber($id)
    {
        $barber = Barber::find($id);

        $this->editBarberData = [
            'id' => $barber->id,
            'name' => $barber->name,
            'status' => $barber->status,
        ];

        $this->confirmingBarberEdit = true;
    }

    public function saveEditedBarber()
    {
        $this->validate([
            'editBarberData.name' => 'required|string|max:255',
            'editBarberData.status' => 'required|in:available,unavailable',
        ]);

        $barber = Barber::findOrFail($this->editBarberData['id']);
        $barber->name = $this->editBarberData['name'];
        $barber->status = $this->editBarberData['status'];
        $barber->save();

        $this->confirmingBarberEdit = false;
        session()->flash('message', 'Barber updated successfully.');
        $this->barbers = Barber::orderBy('created_at', 'desc')->get();
    }

    // This method handes the form submission for adding a new Barber
    public function saveNewBarber()
    {
        $this->validate([
            'newBarber.name' => 'required|string|max:255',
            'newBarber.status' => 'required|in:available,unavailable',
        ]);

        Barber::create([
            'name' => $this->newBarber['name'],
            'status' => $this->newBarber['status'],
        ]);

        // Reset the data and close the modal
        $this->reset('newBarber');
        $this->confirmingAddBarber = false;

        session()->flash('message', 'Barber added successfully!');
        $this->barbers = Barber::orderBy('created_at', 'desc')->get();
    }

    // This method opens the modal to confirm Service deletion
    public function confirmDelete($serviceId)
    {
        $this->barberToDelete = $serviceId;
        $this->confirmingBarberDeletion = true; // Show the modal
    }

    // This method handles the actual deletion
    public function deleteBarber()
    {
        $barber = Barber::find($this->barberToDelete);

        if ($barber) {
            $barber->delete();
            session()->flash('message', 'barber deleted successfully!');
        }

        $this->confirmingBarberDeletion = false; // Close the modal
        $this->barbers =  Barber::orderBy('created_at', 'desc')->get(); // Refresh the list
    }

    public function updateStatus($barberId, $status)
    {
        $barber = Barber::find($barberId);

        if (!$barber) {
            session()->flash('error', 'Barber not found!');
            return;
        }

        if (!in_array($status, ['available', 'unavailable'])) {
            session()->flash('error', 'Invalid status value!');
            return;
        }

        $barber->status = $status;
        $barber->save();

        session()->flash('message', 'Status updated successfully!');
        $this->barbers = Barber::all();
    }


    public function render()
    {
        return view('livewire.barber-page');
    }
}
