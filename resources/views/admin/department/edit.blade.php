@extends('layouts.app')

@section('vendor-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/assets/js/departments.js'])
@endsection

@section('content')

    <x-common.page-breadcrumb :pageTitle="[
    ['name' => 'Departments', 'link'=> route('admin.departments')],
    ['name' => 'Edit Department', 'link'=> '#']
]" />

    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow border border-gray-200 dark:border-gray-700">

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Edit Department</h2>
                <p class="text-sm text-gray-500 dark:text-gray-300">Update department details</p>
            </div>

            <a href="{{ route('admin.departments') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg shadow">
                View Departments
            </a>
        </div>

        <form action="{{ route('admin.departments.update', $department->id) }}"
              method="POST"
              id="departmentForm"
              class="space-y-5">

            @csrf
            @method('PUT')

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Department Name</label>
                    <input type="text" name="name" placeholder="Enter department name"
                           value="{{ old('name', $department->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Department Code</label>
                    <input type="text" name="code" placeholder="e.g. CARD"
                           value="{{ old('code', $department->code) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Head Doctor</label>
                    <select name="head_doctor_id"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500">
                        <option value="" selected disabled>Select Head Doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}"
                                {{ old('head_doctor_id', $department->head_doctor_id) == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->user?->name }} - {{$doctor->specialization}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Phone</label>
                    <input type="text" name="phone" placeholder="Enter phone number"
                           value="{{ old('phone', $department->phone) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" placeholder="Enter department email"
                           value="{{ old('email', $department->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Location</label>
                    <input type="text" name="location" placeholder="e.g. 2nd Floor, Block A"
                           value="{{ old('location', $department->location) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                       bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Status</label>
                    <select name="is_active"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                        bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ old('is_active', $department->is_active) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', $department->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Description</label>
                <textarea name="description" rows="3" placeholder="Enter department description"
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                      bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100
                      placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">{{ old('description', $department->description) }}</textarea>
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('admin.departments') }}"
                   class="px-4 py-2 bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    Update Department
                </button>
            </div>

        </form>

    </div>

@endsection
