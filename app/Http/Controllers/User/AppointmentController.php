<?php

namespace App\Http\Controllers\User;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct(protected AppointmentService $service)
    {
    }

    public function index(Request $request)
    {
        $appointments = $this->service->getForPatient($request->user());
        return ApiResponseHelper::success('Appointments fetched', $appointments);
    }

    public function store(Request $request)
    {
//        return $request->all();
        $data = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date'      => 'required|date|after_or_equal:today',
            'time'      => 'required|string',
            'reason'    => 'required|string|max:500',
        ]);

        $appointment = $this->service->book($request->user(), $data);

        return ApiResponseHelper::success('Appointment requested', $appointment, 201);
    }

    public function cancel(Request $request, Appointment $appointment)
    {
        $updated = $this->service->cancel($appointment, $request->user());
        return ApiResponseHelper::success('Appointment cancelled', $updated);
    }

    public function doctors()
    {
        $doctors = User::role('doctor')
            ->select('id', 'name','avatar')
            ->with('doctorProfile:user_id,specialization')
            ->get()
            ->map(fn ($doc) => [
                'id' => $doc->id,
                'name' => $doc->name,
                'avatar' => $doc->avatar ?? null,
                'specialization' => $doc->doctorProfile?->specialization ?? 'General',
            ]);

        return ApiResponseHelper::success('Doctors fetched', $doctors);
    }
}
