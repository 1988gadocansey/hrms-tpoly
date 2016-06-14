<?php

namespace App\Http\Controllers;
use App\Models; 
use Illuminate\Http\Request;
use App\DataTables\AttendanceDataTable;
use App\Http\Requests;

class AttendanceController extends Controller
{
    //
     public function index(AttendanceDataTable $dataTable)
    {
        return $dataTable->render('patient.attendance');
    }
}
