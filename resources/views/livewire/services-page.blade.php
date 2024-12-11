<div>
    <!-- The Appointment Deletion Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingServiceDeletion">
        <x-slot name="title">
            {{ __('Delete Service') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this service? This action cannot be undone.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingServiceDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button wire:click="deleteService" wire:loading.attr="disabled" class="ms-3">
                {{ __('Delete Service') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-end mt-4 mb-4">
                <x-button wire:click="$toggle('confirmingAddService')" class="ms-4">
                    {{ __('Add Service') }}
                </x-button>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if ($services->isEmpty())
                    <p>No Services available.</p>
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
                            @foreach ($services as $service)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">{{ $service->name }}</td>
                                    <td class="px-6 py-4">{{ $service->status }}</td>
                                    <td class="px-6 py-4">
                                        <select wire:change="updateStatus({{ $service->id }}, $event.target.value)"
                                            class="form-select border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="available"
                                                {{ $service->status == 'available' ? 'selected' : '' }}>
                                                Available
                                            </option>
                                            <option value="unavailable"
                                                {{ $service->status == 'unavailable' ? 'selected' : '' }}>Unavailable
                                            </option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4">

                                        <x-button wire:click="editService{{ $service->id }})" class="ms-4">
                                            {{ __('Edit') }}
                                        </x-button>
                                        <x-danger-button wire:click="confirmDelete({{ $service->id }})"
                                            class="ms-4">
                                            {{ __('Delete') }}
                                        </x-danger-button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Add Service Modal -->
    <x-dialog-modal wire:model="confirmingAddService">
        <x-slot name="title">
            {{ __('Add New Service') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="service_name" value="{{ __('Service Name') }}" />
                <x-input type="text" id="service_name" wire:model.defer="newService.name"
                    class="mt-1 block w-full" />
                <x-input-error for="newService.name" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="service_status" value="{{ __('Service Status') }}" />
                <select wire:model.defer="newService.status" class="form-select mt-1 block w-full">
                    <option value="available">{{ __('Available') }}</option>
                    <option value="unavailable">{{ __('Unavailable') }}</option>
                </select>
                <x-input-error for="newService.status" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingAddService')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="saveNewService" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Edit Barber Modal -->
    <x-dialog-modal wire:model="confirmingServiceEdit">
        <x-slot name="title">
            {{ __('Edit Service') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="edit_barber_name" value="{{ __('Service Name') }}" />
                <x-input type="text" id="edit_service_name" wire:model.defer="editServiceData.name"
                    class="mt-1 block w-full" />
                <x-input-error for="editServiceData.name" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="edit_barber_status" value="{{ __('Status') }}" />
                <select wire:model.defer="editServiceData.status" class="form-select mt-1 block w-full">
                    <option value="available" {{ $editServiceData['status'] === 'available' ? 'selected' : '' }}>
                        Available
                    </option>
                    <option value="unavailable" {{ $editServiceData['status'] === 'unavailable' ? 'selected' : '' }}>
                        Unavailable
                    </option>
                </select>
                <x-input-error for="editServiceData.status" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingServiceEdit')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="saveEditedService" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
