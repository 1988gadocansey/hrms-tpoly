<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentModel;
use App\Models;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
class StudentController extends Controller
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
                 return "<a href=\"show_student/$student->INDEXNO/id\" class=\"\"><i title='Click to view student details' class=\"md-icon material-icons\">&#xE88F;</i></a>";
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
