<?php

namespace App\Modules\Patient\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(){
        return view('admin.patients.index');
    }
}
