<?php

namespace App\Modules\Department\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Department\Models\Department;
use App\Modules\Department\Repositories\DepartmentRepository;
use App\Modules\Department\Requests\StoreDepartmentRequest;
use App\Modules\Department\Requests\UpdateDepartmentRequest;
use App\Modules\Department\Services\DepartmentService;
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
        $doctors = User::all();

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
//            ->with('headDoctor'))
//            ->addColumn('head_doctor', function ($department) {
//                return $department->headDoctor?->name
//                    ?? '<span class="text-gray-400">Not assigned</span>';
//            })
            ->addColumn('status', function ($department) {
                return $department->is_active
                    ? '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Active</span>'
                    : '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Inactive</span>';
            })
//            ->when($request->filled(''))
            ->addColumn('action', function ($department) {
                return '
                <a href="' . route('admin.departments.edit', $department->id) . '" class="text-blue-600 mr-2">Edit</a>
                <button class="text-red-600 deleteBtn" data-id="' . $department->id . '">Delete</button>
            ';
            })
            ->rawColumns(['head_doctor', 'status', 'action'])
            ->make(true);
    }
}
