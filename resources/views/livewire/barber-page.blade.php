<div>
    <!-- The Appointment Deletion Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingBarberDeletion">
        <x-slot name="title">
            {{ __('Delete Barber') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this barber? This action cannot be undone.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingBarberDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button wire:click="deleteBarber" wire:loading.attr="disabled" class="ms-3">
                {{ __('Delete Barber') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barbers') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-end mt-4 mb-4">
                <x-button wire:click="$toggle('confirmingAddBarber')" class="ms-4">
                    {{ __('Add Barber') }}
                </x-button>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if ($barbers->isEmpty())
                    <p>No Barbers available.</p>
                @else
                    <table class="w-full text-sm text-center rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Toggle</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barbers as $barber)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">{{ $barber->name }}</td>
                                    <td class="px-6 py-4">{{ $barber->status }}</td>
                                    <td class="px-6 py-4">
                                        <select wire:change="updateStatus({{ $barber->id }}, $event.target.value)"
                                            class="form-select border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="available"
                                                {{ $barber->status == 'available' ? 'selected' : '' }}>Available
                                            </option>
                                            <option value="unavailable"
                                                {{ $barber->status == 'unavailable' ? 'selected' : '' }}>Unavailable
                                            </option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-4">
                                            <x-button wire:click="editBarber({{ $barber->id }})" class="ms-4">
                                                {{ __('Edit') }}
                                            </x-button>
                                            <x-danger-button wire:click="confirmDelete({{ $barber->id }})"
                                                class="ms-4">
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </div>

                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    < @endif
            </div>
        </div>
    </div>


    <!-- Add Barber Modal -->
    <x-dialog-modal wire:model="confirmingAddBarber">
        <x-slot name="title">
            {{ __('Add New Barber') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="barber_name" value="{{ __('Barber Name') }}" />
                <x-input type="text" id="barber_name" wire:model.defer="newBarber.name" class="mt-1 block w-full" />
                <x-input-error for="newBarber.name" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="barber_status" value="{{ __('Barber Status') }}" />
                <select wire:model.defer="newBarber.status" class="form-select mt-1 block w-full">
                    <option value="available">{{ __('Available') }}</option>
                    <option value="unavailable">{{ __('Unavailable') }}</option>
                </select>
                <x-input-error for="newBarber.status" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingAddBarber')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="saveNewBarber" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Edit Barber Modal -->
    <x-dialog-modal wire:model="confirmingBarberEdit">
        <x-slot name="title">
            {{ __('Edit Barber') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="edit_barber_name" value="{{ __('Barber Name') }}" />
                <x-input type="text" id="edit_barber_name" wire:model.defer="editBarberData.name"
                    class="mt-1 block w-full" />
                <x-input-error for="editBarberData.name" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="edit_barber_status" value="{{ __('Status') }}" />
                <select wire:model.defer="editBarberData.status" class="form-select mt-1 block w-full">
                    <option value="available" {{ $editBarberData['status'] === 'available' ? 'selected' : '' }}>
                        Available
                    </option>
                    <option value="unavailable" {{ $editBarberData['status'] === 'unavailable' ? 'selected' : '' }}>
                        Unavailable
                    </option>
                </select>
                <x-input-error for="editBarberData.status" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingBarberEdit')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="saveEditedBarber" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
