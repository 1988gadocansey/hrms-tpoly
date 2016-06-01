<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeeModel;
use App\Models\FeePaymentModel;
use App\Models\StudentModel; 
use App\Models\ReceiptModel; 
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
 
class FeeController extends Controller
{
    
      public function log_query() {
        \DB::listen(function ($sql, $binding, $timing) {
            \Log::info('showing query', array('sql' => $sql, 'bindings' => $binding));
        }
        );
    }
    /**
     * Create a new controller instance.
     *
     
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

         
    }
    public function getTotalPayment($student,$term,$yearr) {
        $sys=new SystemController();
              $array=$sys->getSemYear();
              if($term=="" && $yearr==""){
              $term=$array[0]->SEMESTER;
              $yearr=$array[0]->YEAR;
              }
               
        $fee=  FeePaymentModel::query()->where('YEAR', '=',$yearr)->where('SEMESTER',$term)->where('INDEXNO',$student)->sum('AMOUNT');
      return $fee;
        
              }
    public function masterLedger(Request $request) {
        $sys=new SystemController();
              $array=$sys->getSemYear();
              $sem=$array[0]->SEMESTER;
              $year=$array[0]->YEAR;
        $fee = FeePaymentModel::query()->where('YEAR', '=', $year);
        if ($request->has('mode') && trim($request->input('mode')) != "") {
            // dd($request);
            $fee->where('PAYMENTDETAILS', "=", $request->input("mode", ""));
        }
        if ($request->has('level') && trim($request->input('level')) != "") {
            $fee->where("LEVEL", $request->input("level", ""));
        }
        if ($request->has('bank') && trim($request->input('bank')) != "") {
            $fee->where("bank", $request->input("bank", ""));
        }
        if ($request->has('year') && trim($request->input('year')) != "") {
            $fee->where("YEAR", "=", $request->input("year", ""));
        }
        if ($request->has('type') && trim($request->input('type'))) {
            $fee->where("PAYMENTTYPE", "=", $request->input('type'));
        }
        if ($request->has('program') && trim($request->input('program'))) {
            $fee->where("PROGRAMME", "=", $request->input('program'));
        }
        if ($request->has('from_date') && $request->has('to_date')) {
            //$fee->whereBetween('TRANSDATE', [$request->input('from_date'), $request->input('to_date')]);
          $fee->whereBetween(\DB::raw('TRANSDATE'), array($request->input('from_date'), $request->input('to_date')));
            }
        if ($request->has('filter') && trim($request->input('filter')) != "" && $request->input('amount') != "") {
            $filter = $request->input('filter');
            $amount = $request->input('amount');
            if ($filter == '=') {
                $fee->where("AMOUNT", "$filter", $amount);
            }
        }
        
        $data = $fee->groupBy('INDEXNO')->orderBy('TRANSDATE', 'DESC')->paginate(100);
        $data->setPath(url("owing_paid"));
        $request->flashExcept("_token");
         \Session::put('students', $data);
        return view('finance.fees.masterLedger')->with("data", $data)
                        ->with('program', $sys->getProgramList())
                        ->with('year',$this->years())
                          ->with('bank',$this->banks());
                       
    }
    
    /*
     * this controller method handles everything about students 
     * who are owing and those who have paid
     */
    public function owingAndPaid(Request $request) {
         $student= StudentModel::query() ;
         if ($request->has('search') && trim($request->input('search')) != "") {
            // dd($request);
            $student->where($request->input('by'), "LIKE", "%" . $request->input("search", "") . "%");
        }
        if ($request->has('program') && trim($request->input('program')) != "") {
            $student->where("PROGRAMMECODE", $request->input("program", ""));
        }
        if ($request->has('level') && trim($request->input('level')) != "") {
            $student->where("LEVEL", $request->input("level", ""));
        }
        if ($request->has('season') && trim($request->input('season')) != "") {
            $student->where("TYPE", "=", $request->input("season", ""));
        }
         if ($request->has('indexno') && trim($request->input('indexno')) != "") {
            $student->where("INDEXNO", "=", $request->input("indexno", ""));
        }
        if ($request->has('type') && trim($request->input('type')) == "owing") {
            $student->where("BILL_OWING", ">", "0");
        }
        if ($request->has('filter') && trim($request->input('filter')) != "" && $request->input('amount') != "") {
            $filter = $request->input('filter');
            $amount = $request->input('amount');
            if ($filter == '=') {
                $student->where("BILL_OWING", "$filter", $amount);
            }
        }
        $sys = new SystemController();
        $data = $student->paginate(100);
        $data->setPath(url("owing_paid"));
        $request->flashExcept("_token");
         \Session::put('students', $data);
        return view('finance.fees.owing')->with("data", $data)
                        ->with('program', $sys->getProgramList());
    }
     public function sendFeeSMS(Request $request){
         $message=$request->input("message", "");
        $query=\Session::get('students');
        $sms= new SystemController();
        
        foreach($query as $rtmt=> $member) {
           
             
             if ($sms->firesms($message,$member->TELEPHONENO,$member->INDEXNO)) {

                \Session::forget('students');
                 return redirect('/owing_paid')->with('success',array('Message sent to students succesfully'));
         
            } else {
                return redirect('/owing_paid')->withErrors("SMS could not be sent.. please verify if you have sms data and internet access.");
            }
        }
    }
    public function new_receiptno(){
        $receiptno_query = Models\Receiptno::first();
		$receiptno_query->increment("receiptno", 1);
        $receiptno = str_pad($receiptno_query->receiptno, 12, "0", STR_PAD_LEFT);
		
        return $receiptno;
        
    }
    
    public function pad_receiptno($receiptno){
       return str_pad($receiptno, 12, "0", STR_PAD_LEFT);
       }
    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getIndex(Request $request)
    {
        
        return view('finance.fees.index');
    }
     public function anyData(Request $request)
    {
         
        $fees = FeeModel::join('tpoly_programme', 'tpoly_fees.PROGRAMME', '=', 'tpoly_programme.PROGRAMMECODE')
           ->select(['tpoly_fees.ID', 'tpoly_fees.NAME','tpoly_fees.DESCRIPTION', 'tpoly_fees.AMOUNT','tpoly_fees.FEE_TYPE','tpoly_fees.SEASON_TYPE','tpoly_programme.PROGRAMME','tpoly_fees.LEVEL','tpoly_fees.SEMESTER','tpoly_fees.YEAR','tpoly_fees.STATUS','tpoly_fees.NATIONALITY']);
         


        return Datatables::of($fees)
                      
            ->addColumn('action', function ($fee) {
                if($fee->STATUS=='approved'){
                    return "<span class='uk-text-success'>Approved ready</span>";
                      } 
                else{
                    return  
                           \Form::open(['action' => ['FeeController@destroy', 'id'=>$fee->ID], 'method' => 'DELETE','name'=>'myform' ,'style' => 'display: inline;'])  
             
                   ." <button type=\"button\" class=\"md-btn  md-btn-danger md-btn-small   md-btn-wave-light waves-effect waves-button waves-light\" onclick=\"UIkit.modal.confirm('Are you sure you want to delete this fee?', function(){ document.forms[0].submit(); });\"><i  class=\"sidebar-menu-icon material-icons md-18\">delete</i></button>
                         <input type='hidden' name='fee' value='$fee->ID'/>  
                      ". \Form::close()."

                    <button title='click to approve fees' type=\"button\" class=\"md-btn  md-btn-primary md-btn-small   md-btn-wave-light waves-effect waves-button waves-light\" onclick=\"UIkit.modal.confirm('Are you sure you want to bill student with this fee item?', function(){   return window.location.href='run_bill/$fee->ID/id'     ; });\"><i  class=\"sidebar-menu-icon material-icons md-18\">done</i></button> 
                       
                   ";
                    
                          
                }
                            
                                         
            })
               ->editColumn('id', '{!! $ID!!}')
            
              
            
            ->setRowId('id')
            ->setRowClass(function ($fee) {
               // return $fee->ID % 2 == 0 ? 'uk-text-success uk-text-bold' : 'uk-text-warning uk-text-bold';
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
    
    // approve bill here
    public function approve(Request $request,$id){
        //get the current user in session
        $user = \Auth::user()->id;
        //  dd($user);
        //get the bill item 
        $query = FeeModel::where('ID', $id)->get()->toArray();
        $programme = $query[0]['PROGRAMME'];
        $amount = $query[0]['AMOUNT'];
        $level = $query[0]['LEVEL'];
        $year = $query[0]['YEAR'];
        $name = $query[0]['NAME'];

        // get students details
        $sql= StudentModel::where("PROGRAMMECODE",$programme)->where('LEVEL',$level)->where('STATUS','=','In school')->update(array("BILLS"=>\DB::raw('BILLS'+ $amount)));
         
         if(!$sql){
      
          return redirect("/view_fees")->withErrors("Error in billing:<span style='font-weight:bold;font-size:13px;'> $name with amount GHC$amount for level $level $programme $year  academic year could not be applied!</span>");
          }else{
           $sql= FeeModel::where("ID",$id)->update(array("APPROVED_BY"=>$user,'STATUS'=>'approved'));
      
           if($sql){
           return redirect("/view_fees")->with("success",array("Following bill:<span style='font-weight:bold;font-size:13px;'>  $name with amount GHC$amount for level $level $programme $year  academic year successfully applied!</span> "));
           }
              
          }
         
    }
    public function showPayform(){
         return view('finance.fees.payfee');
    }
    public function showStudent(Request $request)
    {
        $student=  explode(',',$request->input('q'));
        $student=$student[0];
        
        $sql= StudentModel::where("INDEXNO",$student)->get();
       
        //dd($sql);
         if(count($sql)==0){
      
          return redirect("/pay_fees")->with("error","<span style='font-weight:bold;font-size:13px;'> $request->input('q') does not exist!</span>");
          }
          else{
              $sys=new SystemController();
              $array=$sys->getSemYear();
              $sem=$array[0]->SEMESTER;
              $year=$array[0]->YEAR;
               return view("finance.fees.processPayment")->with( 'data',$sql)->with('year',$year)->with('sem',$sem)->with('banks', $this->banks())->with('receipt', $this->getReceipt());
      
          }
    }
    public function processPayment(Request $request){
              $sys=new SystemController();
              $array=$sys->getSemYear();
              $sem=$array[0]->SEMESTER;
              $year=$array[0]->YEAR;
              $amount=$request->input('amount');
              $receipt=$request->input('receipt');
              $indexno=$request->input('student');
              $owing=$request->input('bill') - $amount;
              $program=$request->input('programme');
              $level=$request->input('level');
              $bank=$request->input('bank');
              $phone=$request->input('phone');
              $details=$request->input('payment_detail');
              $user = \Auth::user()->id;
              $transactionID=$request->input('transaction');
              if ($owing > $amount) {
                    $paymenttype = "Part payment";
                } else {
                    $paymenttype = "Full payment";
                }
                $feetype = "SchoolFees";
                 

                $feeLedger=new FeePaymentModel();
                $feeLedger->INDEXNO=$indexno;
                $feeLedger->PROGRAMME=$program;
                $feeLedger->AMOUNT=$amount;
                $feeLedger->PAYMENTTYPE=$paymenttype;
                $feeLedger->PAYMENTDETAILS=$details;
                
                $feeLedger->LEVEL=$level;
                $feeLedger->RECIEPIENT=$user;
                $feeLedger->BANK=$bank;
                $feeLedger->TRANSACTION_ID=$transactionID;
                $feeLedger->RECEIPTNO=$receipt;
                $feeLedger->YEAR=$year;
                $feeLedger->FEE_TYPE=$feetype;
                $feeLedger->SEMESTER=$sem;
                if($feeLedger->save()){
                    StudentModel::where('INDEXNO',$indexno)->update(array('BILL_OWING'=>$owing));
                    $message="Hi $indexno you have just paid GHC$amount as $feetype remaining GHC$owing";
                    if($sys->firesms($message, $phone, $indexno)){
                     
                       
                     
                     } 
                      $this->updateReceipt();
                     $url = url("printreceipt/".trim($receipt));
                        $print_window = "<script >window.open('$url','','location=1,status=1,menubar=yes,scrollbars=yes,resizable=yes,width=1000,height=500')</script>";
                        $request->session()->flash("success",
			"Payment successfully   $print_window");
                        return redirect("/pay_fees");
                }else{
                    \DB::rollBack();
                 redirect()->back()->with('error','Error processing payment') ;
                            
                 
                }
    }
     public function banks() {

        $banks = \DB::table('tpoly_banks')
                ->lists('NAME', 'ID');
        return $banks;
    }
    public function programmes() {

        $program = \DB::table('tpoly_programme')->get();
                
         foreach($program as $p=>$value){
             $programs[]=$value->PROGRAMMECODE;
         }
         return $programs;
    }
    public function getReceipt(){
        $receiptno_query =  ReceiptModel::first();
		$receiptno =date('Y').str_pad($receiptno_query->no, 5, "0", STR_PAD_LEFT);
                return $receiptno;
		//$receiptno_query->increment("receiptno", 1);
    }
    public function updateReceipt(){
        $query =  ReceiptModel::first();
		 
		return $query->increment("no");
    }
    public function printreceipt(Request $request, $receiptno) {

		// $this->show_query();

		$transaction = FeePaymentModel::where("RECEIPTNO", $receiptno)->with("student", "bank"
                )->first();
        
        if (empty($transaction)) {
            abort(434, "No Fee payment   with this receipt <span class='uk-text-bold uk-text-large'>{{$receiptno}}</span>");
        }

        $words= $this->convert($transaction->AMOUNT);



        return view("finance.fees.receipt")->with("transaction", $transaction)->with('words',$words);
    }
    public function showUpload() {
         return view("finance.fees.upload");
    }
    public function storeUpload(Request $request) {
        //get the current user in session
        $user = \Auth::user()->id;
        $valid_exts = array('csv'); // valid extensions
        $file = $request->file('file');
        $name = time() . '-' . $file->getClientOriginalName();
        if (!empty($file)) {

            $ext = strtolower($file->getClientOriginalExtension());
            $destination = public_path().'\uploads\fees';
            if (in_array($ext, $valid_exts)) {
                  // Moves file to folder on server
            // $file->move($destination, $name);
                if (@$file->move($destination, $name)) {



                    $handle = fopen($destination."/".$name, "r");
                  //  print_r($handle);
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                        $num = count($data);

                        for ($c = 0; $c < $num; $c++) {
                            $col[$c] = $data[$c];
                        }


                        $name = $col[0];
                        $description = $col[1];
                        $amount = $col[2];
                        $type = $col[3];
                        $season = $col[4];
                        $programme = $col[5];
                        $level = $col[6];
                        $sem = $col[7];
                        $year = $col[8];
                        $nationality = $col[9];
                        $programs = $this->programmes(); // check if the programmes in the file tally wat is in the db
                        if (array_search($programme, $programs)) {


                            $fee = new FeeModel();
                            $fee->NAME = $name;

                            $fee->DESCRIPTION = $description;
                            $fee->AMOUNT = $amount;
                            $fee->FEE_TYPE = $type;
                            $fee->SEASON_TYPE = $season;
                            $fee->PROGRAMME = $programme;
                            $fee->LEVEL = $level;
                            $fee->SEMESTER = $sem;
                            $fee->YEAR = $year;
                            $fee->NATIONALITY = $nationality;
                            $fee->CREATED_BY = $user;
                            if ($fee->save()) {

                                return redirect('/view_fees')->with("success", array(" <span style='font-weight:bold;font-size:13px;'>Fees  successfully uploaded!</span> "));
                            } else {
                                return redirect('/view_fees')->back()->withErrors("Fee could not be uploaded");
                            }
                        } else {
                            echo "<script>alert('Please your files contain programme(s) that are not in the system')</script>";
                        }
                    }
                    fclose($handle);
                }
            } else {
                echo "<script>alert('Please upload only csv files')</script>";
            }
        } else {
            echo "<script>alert('Please upload a csv file')</script>";
        }
    }
    public function convert_number($number) {

		if (($number < 0) || ($number > 999999999)) {
			return "$number";
		}

		$Gn = floor($number / 1000000); /* Millions (giga) */
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000); /* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100); /* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10); /* Tens (deca) */
		$n = $number % 10; /* Ones */

		$res = "";

		if ($Gn) {
			$res .= $this->convert_number($Gn) . " Million";
		}

		if ($kn) {
			$res .= (empty($res) ? "" : " ") .
			$this->convert_number($kn) . " Thousand";
		}

		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .
			$this->convert_number($Hn) . " Hundred";
		}

		$ones = array(
			"",
			"One",
			"Two",
			"Three",
			"Four",
			"Five",
			"Six",
			"Seven",
			"Eight",
			"Nine",
			"Ten",
			"Eleven",
			"Twelve",
			"Thirteen",
			"Fourteen",
			"Fifteen",
			"Sixteen",
			"Seventeen",
			"Eighteen",
			"Nineteen");
		$tens = array(
			"",
			"",
			"Twenty",
			"Thirty",
			"Fourty",
			"Fifty",
			"Sixty",
			"Seventy",
			"Eighty",
			"Ninety");

		if ($Dn ||
			$n) {
			if (!empty($res)) {
				$res .= " and ";
			}

			if ($Dn <
				2) {
				$res .= $ones[$Dn *
					10 +
					$n];
			} else {
				$res .= $tens[$Dn];

				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}

		if (empty($res)) {
			$res = "zero";
		}

		return $res;

//$thea=explode(".",$res);
	}

	public function convert($amt) {
//$amt = "190120.09" ;

		$amt = number_format($amt, 2, '.', '');
		$thea = explode(".", $amt);

//echo $thea[0];

		$words = $this->convert_number($thea[0]) . " Ghana Cedis ";
		if ($thea[1] >
			0) {
			$words .= $this->convert_number($thea[1]) . " Pesewas";
		}

		return $words;
	}
         public function countries() {

                 $country=['Ghanaian'=>'Ghanaian','Foriegn'=>'Foriegn'];
                 return $country;
            }

        public function createform(){
           $program = \DB::table('tpoly_programme')
                ->lists('PROGRAMME', 'PROGRAMMECODE');
         return view('finance.fees.create')->with('program',$program)->with('year',$this->years())->with('country', $this->countries());
        
        }
        
        public function years() {
            
             for ($i = 2008; $i <= 2030; $i++) {
             $year = $i - 1 . "/" . $i;
             $years[$year]= $year;
             }
             return $years;
        }
        public function store(Request $request) {
            
            $this->validate($request, ['name' => 'required', 'amount' => 'required', 'programme' => 'required', 'level' => 'required', 'year' => 'required', 'stype' => 'required' ]);
            
            $fee=new FeeModel();
            $fee->NAME=$request->input('name');
           
            $fee->DESCRIPTION=$request->input('description');
            $fee->AMOUNT=$request->input('amount');
            $fee->FEE_TYPE=$request->input('type');
            $fee->SEASON_TYPE=$request->input('stype');
            $fee->PROGRAMME=$request->input('programme');
            $fee->LEVEL=$request->input('level');
            $fee->SEMESTER=$request->input('semester');
            $fee->YEAR=$request->input('year');
            $fee->NATIONALITY=$request->input('country');
            $name=$request->input('name');
             if($fee->save()){
                 
            return redirect()->back()->with("success",array(" <span style='font-weight:bold;font-size:13px;'> $name fee  successfully added!</span> "));
             }
              else{
                  return redirect()->back()->withErrors("Fee could not be added");
     
             }
            
      }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request)
    {
         $query = FeeModel::where('ID',$request->input("id"))->delete();
         
         if ($query) {
             \Session::flash("success", "<span style='font-weight:bold;font-size:13px;'> Fee  </span>successfully deleted!");

             return redirect()->route("view_fees");
        }
    }
}
