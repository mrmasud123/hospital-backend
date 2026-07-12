<?php

namespace App\Repositories;

use App\Models\Appointment;

class AppointmentRepository
{

    public function getForPatient(int $patientId)
    {
        return Appointment::with(['doctor:id,name', 'doctor.doctorProfile:user_id,specialization'])
            ->where('patient_id', $patientId)
            ->orderByDesc('date')
            ->orderByDesc('time')
            ->get();
    }

    public function create(array $data): Appointment
    {
        return Appointment::create($data)->load(['doctor:id', 'doctor.doctorProfile']);
    }

    public function updateStatus(Appointment $appointment, string $status): Appointment
    {
        $appointment->update(['status' => $status]);
        return $appointment->fresh(['doctor:id,name', 'doctor.doctorProfile']);
    }

    public function slotTaken(int $doctorId, string $date, string $time): bool
    {
        return Appointment::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->where('time', $time)
            ->whereNotIn('status', ['cancelled'])
            ->exists();
    }
}
