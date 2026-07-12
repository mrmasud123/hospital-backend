@extends('layouts.app')

@section('vendor-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/assets/js/appointment.js'])
@endsection

@section('content')

    <x-common.page-breadcrumb :pageTitle="[['name' => 'Appointment', 'link'=> '#']]" />

    <div class="bg-white dark:bg-white/5 rounded-2xl shadow-lg p-6">

        <div class="flex justify-between mb-5">
            <h2 class="text-xl font-semibold dark:text-white">Manage Appointments</h2>

            <a href="{{ route('admin.appointments.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                + Add Appointment
            </a>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900 px-3">
            <div class="overflow-x-auto">
                <table id="appointmentTable" class="w-full text-sm">
                    <thead
                        class="bg-gray-50 text-xs uppercase tracking-wider text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-4 text-left">Patient</th>
                        <th class="px-6 py-4 text-left">Doctor</th>
                        <th class="px-6 py-4 text-left">Department</th>
                        <th class="px-6 py-4 text-left">Date</th>
                        <th class="px-6 py-4 text-left">Time</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                    </thead>

                    <tbody
                        class="divide-y divide-gray-100 bg-white dark:divide-gray-800 dark:bg-gray-900">
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
