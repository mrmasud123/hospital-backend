<?php

namespace App\Modules\Appointment\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.appointments.index');
    }

    public function create(Request $request){}

    public function store(Request $request)
    {
        //
    }

    public function edit(Appointment $appointment){
        return $appointment;
    }

    public function show(int $id)
    {
        //
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }

    public function data()
    {
//        $appointments = $this->repository->getAllWithRelations();

        return DataTables::of(Appointment::with([
            'patient:id,name',
            'doctor:id,name',
            'doctor.doctorProfile.department:id,name',
        ])->select('appointments.*')->latest())
            ->addColumn('patient_name', fn ($appt) => $appt->patient?->name ?? 'N/A')
            ->addColumn('doctor_name', fn ($appt) => $appt->doctor?->name ?? 'N/A')
            ->addColumn('department_name', fn ($appt) => $appt->doctor?->doctorProfile?->department?->name ?? 'N/A')
            ->addColumn('status', function ($appt) {
                $colors = [
                    'pending'   => 'bg-amber-100 text-amber-700',
                    'confirmed' => 'bg-green-100 text-green-700',
                    'cancelled' => 'bg-red-100 text-red-700',
                    'completed' => 'bg-gray-100 text-gray-600',
                ];
                $class = $colors[$appt->status] ?? 'bg-gray-100 text-gray-600';
                return '<span class="px-2 py-1 rounded-full text-xs font-medium ' . $class . '">'
                    . ucfirst($appt->status) . '</span>';
            })
            ->addColumn('action', function ($appt) {
                return '
            <div class="flex justify-center gap-2">
                <a href="' . route('admin.appointments.edit', $appt->id) . '"
                   class="text-blue-600 hover:text-blue-800">Edit</a>
                <button class="delete-appointment text-red-600 hover:text-red-800"
                        data-id="' . $appt->id . '">Delete</button>
            </div>
        ';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
}
