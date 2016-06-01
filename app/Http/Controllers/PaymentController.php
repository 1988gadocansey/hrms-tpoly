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
 
class PaymentController extends Controller
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
        
        return view('finance.fees.ledger');
    }
     public function anyData(Request $request)
    {
         
        $fees =  FeePaymentModel::select(['ID','BANK','AMOUNT','LEVEL','FEE_TYPE','INDEXNO','TRANSDATE','TRANSACTION_ID','RECEIPTNO','SEMESTER','YEAR','PAYMENTTYPE','PAYMENTDETAILS'])->get();


        return Datatables::of($fees)
          
            
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
