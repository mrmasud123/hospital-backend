<?php

namespace App\Modules\Doctor\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Department\Models\Department;
use App\Modules\Doctor\Models\DoctorProfile;
use App\Modules\Doctor\Requests\UpdateDoctorRequest;
use App\Modules\Doctor\Services\DoctorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    public function __construct(protected DoctorService $doctorService){}
    public function index(){
//        return User::role('doctor')->with('doctorProfile')->get();
        return view('admin.doctors.index');
    }

    public function create()
    {
        $departments=Department::all();
        return view('admin.doctors.create', compact('departments'));
    }
    public function store()
    {

    }
    public function edit(User $user)
    {
        $doctor= $user->load('doctorProfile');
        $departments=Department::all();
        return view('admin.doctors.edit', compact('doctor','departments'));
    }

    public function update(UpdateDoctorRequest $request, int $id){

//        return $request->validated();
        $this->doctorService->update($id,$request->validated());

        return Redirect::route('admin.doctors.manage')
            ->with('success', 'Doctor updated successfully.');
    }

    public function destroy(User $user){}

    public function data()
    {
        $doctors = User::role('doctor')->with(['doctorProfile.department', 'roles']);

        return DataTables::of($doctors)
            ->addColumn('department', function ($doctor) {
                return $doctor->doctorProfile?->department?->name
                    ?? '<span class="text-gray-400">Not assigned</span>';
            })
            ->addColumn('specialization', function ($doctor) {
                return $doctor->doctorProfile?->specialization
                    ?? '<span class="text-gray-400">—</span>';
            })
            ->addColumn('qualification', function ($doctor) {
                return $doctor->doctorProfile?->qualification ? '<span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">'.$doctor->doctorProfile?->qualification.'</span>' : '<span class="text-gray-400">—</span>';
            })
            ->addColumn('status', function ($doctor) {
                return $doctor->is_active
                    ? '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Active</span>'
                    : '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Inactive</span>';
            })
            ->addColumn('role', function($doctor){
                if(empty($doctor->roles)){
                   return '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">No role</span>';
                }

                $roles=$doctor->roles->map(function($role){
                    return '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">'.$role->name.'</span>';
                })->implode(' ');

                return $roles;
            })
            ->addColumn('action', function ($doctor) {
                return '
                    <a href="'.route('admin.doctors.edit', $doctor->id).'" class="text-blue-600 mr-2">Edit</a>
                    <button class="text-red-600 deleteBtn" data-id="'.$doctor->id.'">Delete</button>
                ';
            })
            ->rawColumns(['department', 'specialization','qualification', 'status','role', 'action'])
            ->make(true);
    }
}
