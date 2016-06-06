<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentModel;
use App\Models;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

         
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getIndex(Request $request)
    {
        
        return view('staff.index');
    }
    public function anyData(Request $request)
    {
         
        $staff = StaffModel::join('tpoly_department', 'tpoly_workers.department', '=', 'tpoly_department.id')
           ->select(['tpoly_staff.ID', 'tpoly_staff.emp_number','tpoly_staff.Name', 'tpoly_staff.othernames','tpoly_staff.surname','tpoly_staff.DISABILITY','tpoly_staff.designation','tpoly_staff.position','tpoly_staff.grade','tpoly_staff.KIN_NAME','tpoly_staff.ssnit','tpoly_staff.placeofresidence'
               ,'tpoly_staff.address','tpoly_staff.region','tpoly_staff.RELIGION','tpoly_staff.phone','tpoly_staff.dob','tpoly_staff.age','tpoly_staff.sex',
               'tpoly_staff.material','tpoly_staff.KIN_ADDRESS','tpoly_staff.KIN_PHONE','tpoly_staff.department','tpoly_staff.datehired'
               
               ]);
         


        return Datatables::of($staff)
            
               ->editColumn('id', '{!! $ID!!}')
            ->addColumn('Photo', function ($staffs) {
               // return '<a href="#edit-'.$student->ID.'" class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light">View</a>';
            
                return' <a href="show_student/'.$staffs->INDEXNO.'/id"><img class="md-user-image-large" style="width:60px;height: auto" src="Albums/students/'.$student->INDEXNO.'.JPG" alt=" Picture of Student Here"    /></a>';
                          
                                         
            })
              
            
            ->setRowId('id')
            ->setRowClass(function ($staffs) {
                return $staffs->ID % 2 == 0 ? 'uk-text-success' : 'uk-text-warning';
            })
            ->setRowData([
                'id' => 'test',
            ])
            ->setRowAttr([
                'color' => 'red',
            ])
                  
            ->make(true);
             
            //flash the request so it can still be available to the view or search form and the search parameters shown on the form 
      //$request->flash();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
        $sql= StudentModel::where("INDEXNO",$id)->first();
        $microscopy_urine= Models\Microscopy_UrineModel::where("PATIENT",$id)->first();
        $microscopy_stool= Models\Microscopy_StoolModel::where("PATIENT",$id)->first();
        $heamatology=  Models\HeamatologyModel::where("PATIENT",$id)->first();
        $chemistry_urine=  Models\Chemistry_ModelUrine::where("PATIENT",$id)->first();
        $chemistry_stool= Models\Chemistry_StoolModel::where("PATIENT",$id)->first();
        $physicals= Models\PhysicalsModel::where("PATIENT",$id)->first();
        $xray= Models\XrayModel::where("PATIENT",$id)->first();
        $macro_stool= Models\Macroscopy_StoolModel::where("PATIENT",$id)->first();
        $widal=  Models\WidalModel::where("PATIENT",$id)->first();
        //dd($sql);
         if(count($sql)==0){
      
          return redirect("/students")->with("error","<span style='font-weight:bold;font-size:13px;'> $id does not exist!</span>");
          }
          else{
               
               return view("students.view")->with('data',$sql)
                       ->with('heamatology', $heamatology)
                       ->with('micro_urine', $microscopy_urine)
                       ->with('micro_stool', $microscopy_stool)
                       ->with('chemistry_urine', $chemistry_urine)
                       ->with('chemistry_stool', $chemistry_stool)
                       ->with('macro_stool', $macro_stool)
                       ->with('widal', $widal)
                       ->with('physical', $physicals)
                       ->with('xray', $xray);
                      
      
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        echo "ss";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
