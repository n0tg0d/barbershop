<div>
    <!-- Modal -->
    @if ($showModal)
        <div class="popup_box" id="appointmentModal">
            <div class="popup_inner">
                <h2>Book an Appointment</h2>

                <form wire:submit.prevent="submitAppointment">
                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <label for="full_name">Full Name</label>
                            <input type="text" id="full_name" wire:model="full_name" required />
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <label for="email">Email</label>
                            <input type="email" id="email" wire:model="email"  />
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" wire:model="phone" required />
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <label for="service">Service</label>
                            <select id="service" wire:model="service_id" required>
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <label for="barber">Barber</label>
                            <select id="barber" wire:model="barber_id" required>
                                <option value="">Select Barber</option>
                                @foreach ($barbers as $barber)
                                    <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <label for="date">Date</label>
                            <input type="date" id="date" wire:model="date" required />
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <label for="time">Time</label>
                            <input type="time" id="time" wire:model="time" required />
                        </div>

                        <div class="col-xl-12">
                            <button type="submit" class="boxed-btn3">Submit</button>
                        </div>
                    </div>
                </form>

                @if (session()->has('message'))
                    <div class="success-message">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Button to close the modal -->
                <button wire:click="hideModal" class="close-btn">Close</button>
            </div>
        </div>
    @endif

</div>
