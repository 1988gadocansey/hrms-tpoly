<?php

namespace App\Http\Controllers;
use App\Models; 
use Illuminate\Http\Request;
use App\DataTables\QueueDataTable;
use App\Http\Requests;
 
use Yajra\Datatables\Datatables;
class QueueController extends Controller
{
    //
     public function getIndex()
    {
       

       return view("patient.queue");
      
    }
    public function anyData(Request $request)
    {
       $date=date("Y-m-d");
       $doctor= \Auth::user()->id;
       $queue = Models\QueueModel::join('tpoly_hrms_patient', 'tpoly_hrm_patientque.PATIENT', '=', 'tpoly_hrms_patient.hospital_id')
           ->select(['*']);
         
                
      // dd($queue);
        if(\Auth::user()->role=='doctor'){
        return Datatables::of($queue)
           
            ->addColumn('action', function ($patient) {
                return
                 "<a href=\"prescribe_test/$patient->PATIENT/id\" ><i title='click to view details and initiate lab test'class=\"md-icon material-icons\">&#xE254;</i></a> 
           
                 <a href=\"prescribte_drugs/$patient->PATIENT/id\" class=\"\"><i title='Click to view patient history details and precscribe test' class=\"md-icon material-icons\">&#xE254;</i></a>";
              
                
            })
             
                 
            ->editColumn('id', ' {{$ID}}')
            ->setRowId('id')
            ->setRowClass(function ($patient) {
                return $patient->ID % 2 == 0 ? 'uk-text-success' : 'uk-text-warning';
            })
            ->setRowData([
                'id' => 'test',
            ])
            ->setRowAttr([
                'color' => 'red',
            ])
            
            ->make(true);
                          
            }
          elseif(\Auth::user()->role=='Laboratory'){
                return Datatables::of($queue)
           
            ->addColumn('action', function ($patient) {
                return
                 "<a href=\"editPatient/$patient->PATIENT/id\" ><i title='click to view patient data'class=\"md-icon material-icons\">&#xE254;</i></a> 
           
                 <a href=\"showPatient/$patient->PATIENT/id\" class=\"\"><i title='Click to add lab test results' class=\"md-icon material-icons\">&#xE88F;</i></a>";
              
                
            })
             
                 
            ->editColumn('id', ' {{$ID}}')
            ->setRowId('id')
            ->setRowClass(function ($patient) {
                return $patient->PATIENT % 2 == 0 ? 'uk-text-success' : 'uk-text-warning';
            })
            ->setRowData([
                'id' => 'test',
            ])
            ->setRowAttr([
                'color' => 'red',
            ])
            
            ->make(true);
               
            }
    
        elseif(\Auth::user()->role=='pharmacy'){
                return Datatables::of($queue)
           
            ->addColumn('action', function ($patient) {
                return
                 "<a href=\"editPatient/$patient->PATIENT/id\" ><i title='click to view patient data'class=\"md-icon material-icons\">&#xE254;</i></a> 
           
                 <a href=\"showPatient/$patient->PATIENT/id\" class=\"\"><i title='Click to precribe drugs' class=\"md-icon material-icons\">&#xE88F;</i></a>";
              
                
            })
             
                 
            ->editColumn('id', ' {{$ID}}')
            ->setRowId('id')
            ->setRowClass(function ($patient) {
                return $patient->PATIENT % 2 == 0 ? 'uk-text-success' : 'uk-text-warning';
            })
            ->setRowData([
                'id' => 'test',
            ])
            ->setRowAttr([
                'color' => 'red',
            ])
            
            ->make(true);
               
            }
            
            elseif(\Auth::user()->role=='records'){
                return Datatables::of($queue)
           
            
                 
            ->editColumn('id', ' {{$ID}}')
            ->setRowId('id')
            ->setRowClass(function ($patient) {
                return $patient->PATIENT % 2 == 0 ? 'uk-text-success' : 'uk-text-warning';
            })
            ->setRowData([
                'id' => 'test',
            ])
            ->setRowAttr([
                'color' => 'red',
            ])
            
            ->make(true);
               
            }
    }
    
}
