<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentModel;
use App\Models;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
class PatientController extends Controller
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
        
        return view('students.index');
    }
    public function anyData(Request $request)
    {
         
        $students = StudentModel::join('tpoly_programme', 'tpoly_students.PROGRAMMECODE', '=', 'tpoly_programme.PROGRAMMECODE')
           ->select(['tpoly_students.ID', 'tpoly_students.NAME','tpoly_students.INDEXNO', 'tpoly_programme.PROGRAMME','tpoly_students.LEVEL','tpoly_students.INDEXNO','tpoly_students.SEX','tpoly_students.AGE','tpoly_students.TELEPHONENO','tpoly_students.COUNTRY','tpoly_students.GRADUATING_GROUP','tpoly_students.STATUS']);
         


        return Datatables::of($students)
                         
            ->addColumn('action', function ($student) {
                 return "<a href=\"edit_student/$student->INDEXNO/id\" class=\"\"><i title='Click to view student details' class=\"md-icon material-icons\">&#xE88F;</i></a>";
                 // use <i class=\"md-icon material-icons\">&#xE254;</i> for showing editing icon
                //return' <td> <a href=" "><img class="" style="width:70px;height: auto" src="public/Albums/students/'.$student->INDEXNO.'.JPG" alt=" Picture of Employee Here"    /></a>df</td>';
                          
                                         
            })
               ->editColumn('id', '{!! $ID!!}')
            ->addColumn('Photo', function ($student) {
               // return '<a href="#edit-'.$student->ID.'" class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light">View</a>';
            
                return' <a href="show_student/'.$student->INDEXNO.'/id"><img class="md-user-image-large" style="width:60px;height: auto" src="Albums/students/'.$student->INDEXNO.'.JPG" alt=" Picture of Student Here"    /></a>';
                          
                                         
            })
              
            
            ->setRowId('id')
            ->setRowClass(function ($student) {
                return $student->ID % 2 == 0 ? 'uk-text-success' : 'uk-text-warning';
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
    public function showMedicalForm(Request $request) {
        return view("patient.students.medicals");
    }
    public function processMedicalForm(Request $request) {
        
        $student=  explode(',',$request->input('q'));
        $student=$student[0];
        
        $sql= StudentModel::where("INDEXNO",$student)->get();
        //dd($sql);
         if(count($sql)==0){
      
          return redirect("/student_medicals")->with("error","<span style='font-weight:bold;font-size:13px;'> $request->input('q') does not exist!</span>");
          }
          else{
              $sys=new SystemController();
              $array=$sys->getSemYear();
              $sem=$array[0]->SEMESTER;
              $year=$array[0]->YEAR;
               return view("patient.students.medicals_form2")->with( 'data',$sql)->with('year', $year)->with('test',$this->getTests());
      
          }
    }
    public function getTests(){
         $test = \DB::table('tpoly_tests')
                ->lists('NAME', 'ID');
        return $test;
    }
    public function storeMedicals(Request $request) {
         //get the current user in session
        $user = \Auth::user()->id;
              // Lab - heamatlology
       /* $heamatology=new Models\HeamatologyModel();
        $heamatology->PATIENT=$request->input('student');
        $heamatology->HB_FEMALE=$request->input('hb_female');
        $heamatology->HB_MALE=$request->input('hb_male');
        $heamatology->PLATES=$request->input('plates');
        $heamatology->HBS_AG=$request->input('hbs');
        $heamatology->WBCS=$request->input('wbc');
        $heamatology->G6DP=$request->input('g6dp');
        $heamatology->PCV_MALE=$request->input('pcv_male');
        $heamatology->PCV_FEMALE=$request->input('pcv_female');
        $heamatology->ESR_FEMALE=$request->input('esr_female');
        $heamatology->ESR_MALE=$request->input('esr_male');
        $heamatology->HBS_AG=$request->input('hbs');
        $heamatology->RETICULOCYTES=$request->input('reticulocytes');
        $heamatology->SICKLING=$request->input('sickling');
        $heamatology->BF=$request->input('bf');
        $heamatology->BLOOD_GROUP=$request->input('blood_group');
        $heamatology->HB_ELECTROPHORESIS=$request->input('electrophoresis');
        $heamatology->ENTERED_BY=$user;
        $heamatology->save();
        
        // parasitology
          
        $macro_stool=new Models\Macroscopy_StoolModel();
        $macro_stool->MACROSCOPY=$request->input('macroscopy');
        $macro_stool->PATIENT=$request->input('student');
        $macro_stool->ENTERED_BY=$user;
        $macro_stool->save();
        
        // microscopy stool
        $microscopy_stool=new Models\Microscopy_StoolModel();
        $microscopy_stool->PATIENT=$request->input('student');
        $microscopy_stool->OVA=$request->input('ova');
        $microscopy_stool->MICROSCOPY=$request->input('microscopy');
        $microscopy_stool->LARVAE=$request->input('larvae');
        $microscopy_stool->VEGETATIVE=$request->input('vegetative');
        $microscopy_stool->CYTES=$request->input('cytes');
        $microscopy_stool->RBC=$request->input('rbc');
        $microscopy_stool->WBC=$request->input('wbc');
        $microscopy_stool->ENTERED_BY=$user;
        $microscopy_stool->save();
                
        // chemistry stool
        $chemistry_stool=new Models\Chemistry_StoolModel();
        $chemistry_stool->OCCULT_BLOOD_CELL=$request->input('obc');
        $chemistry_stool->PATIENT=$request->input('student');
        $chemistry_stool->ENTERED_BY=$user;
        $chemistry_stool->save();
        
        //parasitology -- urine
        $microscopy_urine=new Models\Microscopy_UrineModel();
        $microscopy_urine->PATIENT=$request->input('student');
        $microscopy_urine->PLUS_CELL_PER_HIGH=$request->input('plus_');
        $microscopy_urine->RBC=$request->input('rbc_');
        $microscopy_urine->EPITH=$request->input('epith_');
        $microscopy_urine->CRYSTALS=$request->input('crystals_');
        $microscopy_urine->HAEMOTOBIUM_OVA=$request->input('haematobium_');
        $microscopy_urine->TVAGINALIS=$request->input('vagina_');
        $microscopy_urine->CANDIDA=$request->input('candida_');
        $microscopy_urine->CAST=$request->input('cast_');
        $microscopy_urine->ENTERED_BY=$user;
        $microscopy_urine->save();
        
        // chemistry urine
        $chemistry_urine=new Models\Chemistry_ModelUrine();
        $chemistry_urine->PATIENT=$request->input('student');
        $chemistry_urine->BLOOD=$request->input('blood_');
        $chemistry_urine->KETONES=$request->input('blood_');
        $chemistry_urine->GLUCOSE=$request->input('glucose_');
        $chemistry_urine->PH=$request->input('ph_');
        $chemistry_urine->PROTIEN=$request->input('protein_');
        $chemistry_urine->SP_GRAVITY=$request->input('gravity_');
        $chemistry_urine->BILE_PIGMENTS=$request->input('bile_pigments_');
        $chemistry_urine->BILE_SALTS=$request->input('bile_salt_');
        $chemistry_urine->UROBILINNOGEN=$request->input('uro_');
        $chemistry_urine->BILIRUBIN=$request->input('bilrubin');
        $chemistry_urine->ENTERED_BY=$user;
        $chemistry_urine->save();
          
        // widal
        $widal=new Models\WidalModel();
        $widal->PATIENT=$request->input('student');
        $widal->ANTIGEN=$request->input('widal');
        $widal->ENTERED_BY=$user;
        $widal->save();
        
        // physicals
        $physicals=new Models\PhysicalsModel();
        $physicals->PATIENT=$request->input('student');
        $physicals->TYPE=$request->input('physicals');
        $physicals->ENTERED_BY=$user;
        $physicals->save();
        
        // x-ray
         $xray=new Models\XrayModel();
        $xray->PATIENT=$request->input('student');
        $xray->TYPE=$request->input('xray');
        $xray->ENTERED_BY=$user;
        * 
        */
        $patient=$request->input('patient');
        $total=count($request->input('test')); // total test user inputed on the form
        
        $result=$request->input('result');
        $test=$request->input('test');
        $specimen=$request->input('specimen');
        $diagnosis=$request->input('diagnosis');
        $source=$request->input('source');
       
      for($i=0;$i<$total;$i++){
           $laboratory=new Models\LabModel();
           $laboratory->PATHOLOY_NO=223;
           $laboratory->TEST=$test[$i];
           $laboratory->RESULT=$result[$i];
           $laboratory->SPECIMEN=$specimen[$i];
           $laboratory->SOURCE=$test[$i];
           $laboratory->DIAGNOSIS=$diagnosis[$i];
           $laboratory->SOURCE=$source[$i];
           $laboratory->PATIENT=$patient;
           $laboratory->CLINICIAN=$user;
           $laboratory->save();
          
      }
        
       if($laboratory){
      
           
           return redirect("/students")->with("success",array("<span style='font-weight:bold;font-size:13px;'>  Records successfully saved!</span> "));
        }
        else{
            redirect()->back()->withErrors('error', 'Error in saving records');
        }
               
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
    public function displayFolder(Request $request){
        
    }
    public function showVisitForm(Request $request) {
        return view('patient.new_visit');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function searchFolder(){
         return view('patient.folder_search');
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
