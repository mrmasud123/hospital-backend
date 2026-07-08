<?php

namespace App\Modules\Department\Models;

use App\Modules\Doctor\Models\DoctorProfile;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $guarded = [];


    public function headDoctor(){
        return $this->belongsTo(DoctorProfile::class,'head_doctor_id','id');
    }
}
