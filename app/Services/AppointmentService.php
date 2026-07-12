<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\User;
use App\Repositories\AppointmentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AppointmentService
{
    public function __construct(protected AppointmentRepository $repository)
    {
    }

    public function getForPatient(User $patient)
    {
        return $this->repository->getForPatient($patient->id);
    }

    public function book(User $patient, array $data): Appointment
    {
        $this->assertSlotAvailable($data['doctor_id'], $data['date'], $data['time']);

        return $this->repository->create([
            'patient_id' => $patient->id,
            'doctor_id'  => $data['doctor_id'],
            'date'       => $data['date'],
            'time'       => $data['time'],
            'reason'     => $data['reason'],
            'status'     => 'pending',
        ]);
    }

    public function cancel(Appointment $appointment, User $patient): Appointment
    {
        if ($appointment->patient_id !== $patient->id) {
            throw ValidationException::withMessages([
                'appointment' => 'You are not authorized to cancel this appointment.',
            ]);
        }

        if (in_array($appointment->status, ['cancelled', 'completed'])) {
            throw ValidationException::withMessages([
                'appointment' => 'This appointment can no longer be cancelled.',
            ]);
        }

        return $this->repository->updateStatus($appointment, 'cancelled');
    }

    protected function assertSlotAvailable(int $doctorId, string $date, string $time): void
    {
        if ($this->repository->slotTaken($doctorId, $date, $time)) {
            throw ValidationException::withMessages([
                'time' => 'This slot is no longer available. Please choose another time.',
            ]);
        }
    }
}
