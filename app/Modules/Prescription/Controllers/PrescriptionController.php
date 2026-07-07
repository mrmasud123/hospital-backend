<?php

namespace App\Modules\Prescription\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index(){
        return view('admin.prescription.index');
    }
}
