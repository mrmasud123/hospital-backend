<?php

namespace App\Modules\Department\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Department\Models\Department;
use App\Modules\Department\Repositories\DepartmentRepository;
use App\Modules\Department\Requests\StoreDepartmentRequest;
use App\Modules\Department\Requests\UpdateDepartmentRequest;
use App\Modules\Department\Services\DepartmentService;
use App\Modules\Doctor\Models\DoctorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function __construct(protected DepartmentService $departmentService){}
    public function index(){
        return view('admin.department.index');
    }

    public function create(){
        $doctors=[];
        return view('admin.department.create', compact('doctors'));
    }

    public function store(StoreDepartmentRequest $request)
    {
        $this->departmentService->create($request->validated());

        return Redirect::route('admin.departments')
            ->with('success', 'Department created successfully.');
    }

    public function edit(int $id)
    {
        $department = $this->departmentService->find($id);
        $doctors = DoctorProfile::with('user')->get();

        return view('admin.department.edit', compact('department', 'doctors'));
    }

    public function update(UpdateDepartmentRequest $request, int $id)
    {
        $this->departmentService->update($id, $request->validated());

        return Redirect::route('admin.departments')
            ->with('success', 'Department updated successfully.');
    }

    public function data(Request $request)
    {
        return DataTables::of(Department::query())
            ->with('headDoctor.user')
            ->addColumn('head_doctor', function ($department) {
                return $department->headDoctor->user?->name
                    ?? '<span class="text-gray-400">Not assigned</span>';
            })
            ->addColumn('status', function ($department) {

                if($department->is_active){

                    return '
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            Active
                        </span>';
                                }

                                return '
                    <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700 dark:bg-red-900/30 dark:text-red-400">
                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                        Inactive
                    </span>';
                            })
            ->addColumn('action', function ($department) {
                return '<div class="flex justify-center gap-2">

                    <a href="'.route('admin.departments.edit',$department->id).'"
                    class="rounded-lg bg-indigo-50 px-3 py-2 text-indigo-600 transition hover:bg-indigo-100 dark:bg-indigo-900/30 dark:text-indigo-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a2.121 2.121 0 113 3L10.582 16.767a4.5 4.5 0 01-1.897 1.13L6 18l.103-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z"/>
                    </svg>

                    </a>

                    <button
                    data-id="'.$department->id.'"
                    class="deleteBtn rounded-lg bg-red-50 px-3 py-2 text-red-600 transition hover:bg-red-100 dark:bg-red-900/30 dark:text-red-400">

                    <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="h-4 w-4">

                    <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 7h12M9 7V4h6v3m-7 4v6m4-6v6m4-6v6M5 7l1 13h12l1-13"/>

                    </svg>

                    </button>

                    </div>

                    ';

                                })
            ->rawColumns(['head_doctor', 'status', 'action'])
            ->make(true);
    }
}
