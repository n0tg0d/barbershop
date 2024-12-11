<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
        <!-- Appointments Card -->
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-lg font-bold">Appointments</h2>
            <p class="text-4xl font-extrabold text-blue-600">{{ $appointmentCount }}</p>
        </div>

        <!-- Services Card -->
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-lg font-bold">Services</h2>
            <p class="text-4xl font-extrabold text-green-600">{{ $serviceCount }}</p>
        </div>

        <!-- Barbers Card -->
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-lg font-bold">Barbers</h2>
            <p class="text-4xl font-extrabold text-red-600">{{ $barberCount }}</p>
        </div>
    </div>
</div>
