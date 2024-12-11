<div>

    <!-- The Appointment Deletion Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingAppointmentDeletion">
        <x-slot name="title">
            {{ __('Delete Appointment') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this appointment? This action cannot be undone.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingAppointmentDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button wire:click="deleteAppointment" wire:loading.attr="disabled" class="ms-3">
                {{ __('Delete Appointment') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if ($appointments->isEmpty())
                    <p>No appointments available.</p>
                @else
                    <table class="w-full text-sm text-center rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Time</th>
                                <th scope="col" class="px-6 py-3">Full Name</th>
                                <th scope="col" class="px-6 py-3">Service</th>
                                <th scope="col" class="px-6 py-3">Barber</th>
                                <th scope="col" class="px-6 py-3">Phone</th>

                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-3">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">{{ $appointment->appointment_time }}</td>
                                    <td class="px-6 py-4">{{ $appointment->full_name }}</td>
                                    <td class="px-6 py-4">
                                        @if ($appointment->services->isEmpty())
                                            <p>Service no longer exists</p>
                                        @else
                                            @foreach ($appointment->services as $service)
                                                <p>{{ $service->name }}</p>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $appointment->barber->name ?? 'No barber assigned' }}</td>
                                    <td class="px-6 py-4">{{ $appointment->phone }}</td>

                                    <td class="px-6 py-4">
                                        <select wire:change="updateStatus({{ $appointment->id }}, $event.target.value)"
                                            class="form-select">
                                            <option value="pending"
                                                {{ $appointment->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="confirmed"
                                                {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>
                                                Confirmed
                                            </option>
                                            <option value="canceled"
                                                {{ $appointment->status == 'canceled' ? 'selected' : '' }}>
                                                Canceled
                                            </option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-4">
                                            <x-button wire:click="editAppointment({{ $appointment->id }})"
                                                class="ms-4">
                                                {{ __('Edit') }}
                                            </x-button>
                                            <x-danger-button wire:click="confirmDelete({{ $appointment->id }})"
                                                class="ms-4">
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @endif
            </div>
        </div>
    </div>

    <!-- Edit Appointment Modal -->
    <x-dialog-modal wire:model="confirmingAppointmentEdit">
        <x-slot name="title">
            {{ __('Edit Appointment') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="edit_appointment_date" value="{{ __('Date') }}" />
                <x-input type="date" id="edit_appointment_date"
                    wire:model.defer="editAppointmentData.appointment_date" class="mt-1 block w-full" />
                <x-input-error for="editAppointmentData.appointment_date" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="edit_appointment_time" value="{{ __('Time') }}" />
                <x-input type="time" id="edit_appointment_time"
                    wire:model.defer="editAppointmentData.appointment_time" class="mt-1 block w-full" />
                <x-input-error for="editAppointmentData.appointment_time" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="edit_full_name" value="{{ __('Full Name') }}" />
                <x-input type="text" id="edit_full_name" wire:model.defer="editAppointmentData.full_name"
                    class="mt-1 block w-full" />
                <x-input-error for="editAppointmentData.full_name" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="edit_service_name" value="{{ __('Service') }}" />
                <select wire:model.defer="editAppointmentData.service_id" class="form-select mt-1 block w-full">
                    <option value="">{{ __('Select Service') }}</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="editAppointmentData.service_id" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="edit_barber_id" value="{{ __('Barber') }}" />
                <select wire:model.defer="editAppointmentData.barber_id" class="form-select mt-1 block w-full">
                    <option value="">{{ __('Select Barber') }}</option>
                    @foreach ($barbers as $barber)
                        <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="editAppointmentData.barber_id" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="edit_phone" value="{{ __('Phone') }}" />
                <x-input type="text" id="edit_phone" wire:model.defer="editAppointmentData.phone"
                    class="mt-1 block w-full" />
                <x-input-error for="editAppointmentData.phone" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label for="edit_status" value="{{ __('Status') }}" />
                <select wire:model.defer="editAppointmentData.status" class="form-select mt-1 block w-full">
                    <option value="pending" {{ $editAppointmentData['status'] === 'pending' ? 'selected' : '' }}>
                        Pending</option>
                    <option value="confirmed" {{ $editAppointmentData['status'] === 'confirmed' ? 'selected' : '' }}>
                        Confirmed</option>
                    <option value="canceled" {{ $editAppointmentData['status'] === 'canceled' ? 'selected' : '' }}>
                        Canceled</option>
                </select>
                <x-input-error for="editAppointmentData.status" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingAppointmentEdit')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="saveEditedAppointment" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
