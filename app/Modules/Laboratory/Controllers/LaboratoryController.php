<?php

namespace App\Modules\Laboratory\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index(){
        return view('admin.laboratory.index');
    }
}
