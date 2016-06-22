<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestModel;
use App\Models;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
class TestController extends Controller
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
        
        return view('laboratory.test');
    }
    public function anyData(Request $request)
    {
         
         $tests = Models\TestModel::select([ "*"]);

        return Datatables::of($tests)
            ->addColumn('action', function ($test) {
                return
                 "<a href=\"editPatient/$test->ID/id\" ><i title='click to edit patient data'class=\"md-icon material-icons\">&#xE254;</i></a> 
           
                 <a href=\"showPatient/$test->ID/id\" class=\"\"><i title='Click to view patient history details' class=\"md-icon material-icons\">&#xE88F;</i></a>";
              
                
            })
            
            ->editColumn('id', ' {{$ID}}')
            ->setRowId('id')
            ->setRowClass(function ($test) {
                return $test->ID % 2 == 0 ? 'uk-text-success' : 'uk-text-warning';
            })
            ->setRowData([
                'id' => 'test',
            ])
            ->setRowAttr([
                'color' => 'red',
            ])
            
            ->make(true);
                          
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
    public function getDrugs(){
         $drug = \DB::table('tpoly_drugs')
                ->lists('NAME', 'ID');
        return $drug;
    }
    // get one patient visit history from the attendance table
    public function getHistory($patient){
         $history = Models\AttendanceModel::query()->where('patient',$patient)->orderby('date','DESC')
                ->paginate(100);
        return $history;
    }
    // lab history of patient here
    public function getLabHistory($patient){
         $history = Models\LabModel::query()->where('patient',$patient)->orderby('DATE','DESC')
                ->paginate(100);
        return $history;
    }
    // drug dispensary history of patient here
    public function getDrugHistory($patient){
         $history = Models\PrescriptionModel::query()->where('patient_id',$patient)->orderby('timestamp','DESC')
                ->paginate(100);
        return $history;
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
    
    public function showOldVistForm(Request $request) {
        return view("patient.old_visit");
    }
    public function processOldVisitForm(Request $request,  SystemController $sys) {
        $patient=  explode(',',$request->input('q'));
        $patient=$patient[0];
        $history=  $this->getHistory($patient);
        $lab=  $this->getLabHistory($patient);
        $drug=  $this->getDrugHistory($patient);
        $sql= Models\PatientModel::where("hospital_id",$patient)->get();
        $doctor=$sys->getDoctorList();
         if(count($sql)==0){
      
          return redirect("/patients")->with("error","<span style='font-weight:bold;font-size:13px;'> $request->input('q') does not exist!</span>");
          }
          else{
            if(\Auth::user()->role=='doctor'){
               return view("patient.visit_transaction")->with( 'data',$sql)->with('drug', $this->getDrugs())->with('test',$this->getTests())->with('history',$history)->with('lab',$lab)->with('drug',$drug);
            }
            elseif (\Auth::user()->role=='records') {
                 return view("patient.records_visit_transaction")->with( 'data',$sql)->with('drug', $this->getDrugs())->with('test',$this->getTests())->with('history',$history)->with('lab',$lab)->with('drug',$drug)->with('doctor', $doctor);
        
            }
            elseif (\Auth::user()->role=='pharmacy') {
                 return view("patient.pharmacy_visit_transaction")->with( 'data',$sql)->with('drug', $this->getDrugs())->with('test',$this->getTests())->with('history',$history)->with('lab',$lab)->with('drug',$drug);
        
            }
             elseif (\Auth::user()->role=='Laboratory') {
                 return view("patient.lab_visit_transaction")->with( 'data',$sql)->with('drug', $this->getDrugs())->with('test',$this->getTests())->with('history',$history)->with('lab',$lab)->with('drug',$drug);
        
            }
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
        $sys=new SystemController();
        return view('patient.new_visit')->with('staff',$sys->getstaffList())
                ->with('student',$sys->getstudentList())
                ->with('doctor',$sys->getDoctorList());
    }
    public function storeVist(Request $request) {
        
         $this->validate($request, ['title' => 'required', 'fname' => 'required', 'surname' => 'required', 'dob' => 'required', 'gender' => 'required', 'marital_status' => 'required', 'temperature' => 'required', 'contact' => 'required', 'hometown' => 'required', 'dob' => 'required', 'phone' => 'required', 'height' => 'required', 'weight' => 'required','bp' => 'required' ]);
        $user=\Auth::id();
        $sys=new SystemController();
        $code=$sys->getHospitalID();
        $hospitalCode=\date("Y").$code[0];
        $patientModel=new Models\PatientModel();
        $patientModel->hospital_id=$hospitalCode;
        $patientModel->title=$request->input("title");
        $patientModel->firstname=$request->input('fname');
        $patientModel->othername=$request->input('othernames');
        $patientModel->surname=$request->input('surname');
        $patientModel->date_of_birth=$request->input('dob');
        $patientModel->age=$sys->age($request->input('dob'),'eu');
        $patientModel->sex=$request->input('gender');
        $patientModel->nhis_id=$request->input('nhis');
        $patientModel->cs_number=$request->input('csno');
        $patientModel->marital_status=$request->input('marital_status');
        $patientModel->occupation=$request->input('occupation');
        $patientModel->address=$request->input('contact');
        $patientModel->contact_number=$request->input('phone');
        $patientModel->placeofResidence=$request->input('hometown');
        $patientModel->lastVisit=$request->input('lastVisit');
        $patientModel->referedFrom=$request->input('referer');
        $patientModel->staff=$request->input('staff');
        $patientModel->student=$request->input('student');
        $patientModel->enteredBy=$user;
        $vitals=new Models\VitalsModel();
        //$patient=$patientModel->save()->id;
        if($patientModel->save()){
            
         $vitals->BP=$request->input('bp');
         $vitals->PATIENT=$hospitalCode;
         $vitals->TEMPERATURE=$request->input('temperature');
         $vitals->HEIGHT=$request->input('height');
         $vitals->WEIGHT=$request->input('weight');
         $vitals->ENTERED_BY=$user;
         
         // push the patient into the patient queue
         //$queue=new Models\QueueModel();
            if($vitals->save()){
                
               
                    \DB::table('tpoly_hospitalid')->increment("NO");
                    $queue=new Models\QueueModel();
                    $queue->PATIENT=$hospitalCode;
                    $queue->PATIENT=$user;
                    $queue->FOR_DOCTOR=$request->input('doctor');
                     $queue->PUSHED_BY=$user;
                    if($queue->save()){
                  return redirect("/patients")->with("success",array("<span style='font-weight:bold;font-size:13px;'>  Patient with hospital code $hospitalCode successfully saved!</span> "));
                    
                    }
                 
            }
         }
        else{
            redirect()->back()->withErrors('error', 'Error in saving records');
        }
    }
  
    
     
    public function saveVisit(Request $request) {
            $user=\Auth::id();
            $sys=new SystemController();
            $vitals=new Models\VitalsModel();
            //dd(\Auth::user()->role);
            if(\Auth::user()->role=='records'){
                //$this->validate($request, ['bp' => 'required', 'temparature' => 'required', 'weight' => 'required', 'height' => 'required' ,'doctor'=>'required']);

                    $vitals->BP=$request->input('bp');
                    
                    $vitals->TEMPERATURE=$request->input('temperature');
                    $vitals->HEIGHT=$request->input('height');
                    $vitals->WEIGHT=$request->input('weight');
                    $vitals->ENTERED_BY=$user;
         
         // push the patient into the patient queue
         //$queue=new Models\QueueModel();
                    if($vitals->save()) {



                           $queue = new Models\QueueModel();
                           $queue->PATIENT = $request->input('code');
                           $folder=$request->input('code');
                           $queue->FOR_DOCTOR = $request->input('doctor');
                           $queue->PUSHED_BY = $user;
                           if ($queue->save()) {
                               return redirect("/patients")->with("success", array("<span style='font-weight:bold;font-size:13px;'>  Patient with folder no $folder successfully sent to consulting room!</span> "));
                           }
                       }
                   }
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
