<?php

namespace App\Modules\Doctor\Models;

use App\Models\User;
use App\Modules\Department\Models\Department;
use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    protected $guarded  = [];
    protected $table = 'doctor_profiles';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
