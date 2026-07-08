@extends('layouts.app')

@section('vendor-scripts')
    @vite(['resources/assets/js/departments.js'])
@endsection

@section('content')

    <x-common.page-breadcrumb :pageTitle="[['name' => 'Department', 'link'=> '#']]" />

    <div class="bg-white dark:bg-white/5 rounded-2xl shadow-lg p-6">

        <div class="flex justify-between mb-5">
            <h2 class="text-xl font-semibold dark:text-white">Manage Department</h2>

            <a href="{{ route('admin.departments.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                + Add Department
            </a>
        </div>

{{--        <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 p-4">--}}
{{--            <table id="departmentTable" class="datatable w-full text-sm">--}}

{{--                <thead class="bg-gray-50 dark:bg-gray-800">--}}
{{--                <tr class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">--}}
{{--                    <th class="px-4 py-3 text-left!">Name</th>--}}
{{--                    <th class="px-4 py-3 text-left!">Code</th>--}}
{{--                    <th class="px-4 py-3 text-left!">Head Doctor</th>--}}
{{--                    <th class="px-4 py-3 text-right!">Phone</th>--}}
{{--                    <th class="px-4 py-3 text-center!">Status</th>--}}
{{--                    <th class="px-4 py-3 text-right!">Action</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}

{{--                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-gray-900">--}}
{{--                </tbody>--}}

{{--            </table>--}}
{{--        </div>--}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900 px-3">
            <div class="overflow-x-auto">
                <table id="departmentTable" class="w-full text-sm">
                    <thead
                        class="bg-gray-50 text-xs uppercase tracking-wider text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-4 text-left">Department</th>
                        <th class="px-6 py-4 text-left">Code</th>
                        <th class="px-6 py-4 text-left">Head Doctor</th>
                        <th class="px-6 py-4 text-left">Phone</th>
                        <th class="px-6 py-4 text-left">Location</th>
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
