@extends('layouts.app')

@section('vendor-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/assets/js/doctors.js'])
@endsection

@section('content')

    <x-common.page-breadcrumb :pageTitle="[
    ['name' => 'Doctors', 'link'=> route('admin.doctors.manage')],
    ['name' => 'Edit Doctor', 'link'=> '#']
]" />

    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow border border-gray-200 dark:border-gray-700">

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Edit Doctor</h2>
                <p class="text-sm text-gray-500 dark:text-gray-300">Update doctor account and profile</p>
            </div>

            <a href="{{ route('admin.doctors.manage') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg shadow">
                View Doctors
            </a>
        </div>

        <form action="{{ route('admin.doctors.update', $doctor->id) }}"
              method="POST"
              id="doctorForm"
              class="space-y-5">

            @csrf
            @method('PUT')

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Full Name</label>
                    <input type="text" name="name" placeholder="Enter doctor's full name"
                           value="{{ old('name', $doctor->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" placeholder="Enter email address"
                           value="{{ old('email', $doctor->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>

{{--                <div class="flex-1">--}}
{{--                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Phone</label>--}}
{{--                    <input type="text" name="phone" placeholder="Enter phone number"--}}
{{--                           value="{{ old('phone', $doctor->phone) }}"--}}
{{--                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg--}}
{{--                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100--}}
{{--                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">--}}
{{--                </div>--}}
            </div>

{{--            <div class="flex gap-4">--}}
{{--                <div class="flex-1">--}}
{{--                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">--}}
{{--                        New Password <span class="text-xs text-gray-400">(leave blank to keep current)</span>--}}
{{--                    </label>--}}
{{--                    <input type="password" name="password" placeholder="Enter new password"--}}
{{--                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg--}}
{{--                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100--}}
{{--                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">--}}
{{--                </div>--}}

{{--                <div class="flex-1">--}}
{{--                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Confirm Password</label>--}}
{{--                    <input type="password" name="password_confirmation" placeholder="Re-enter new password"--}}
{{--                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg--}}
{{--                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100--}}
{{--                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Department</label>
                    <select name="department_id"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ old('department_id', $doctor->doctorProfile?->department_id) == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Specialization</label>
                    <input type="text" name="specialization" placeholder="e.g. Cardiologist"
                           value="{{ old('specialization', $doctor->doctorProfile?->specialization) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Qualification</label>
                    <input type="text" name="qualification" placeholder="e.g. MBBS, MD"
                           value="{{ old('qualification', $doctor->doctorProfile?->qualification) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Consultation Fee</label>
                    <input type="number" step="0.01" name="consultation_fee" placeholder="e.g. 500.00"
                           value="{{ old('consultation_fee', $doctor->doctorProfile?->consultation_fee) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('admin.doctors.manage') }}"
                   class="px-4 py-2 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    Update Doctor
                </button>
            </div>

        </form>

    </div>

@endsection
