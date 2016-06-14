<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Response;

class SearchController extends Controller
{
    function index(){
        return view('autocomplete');
    }

    public function autocomplete(){
	$term = Input::get('term');
	
	$results = array();
	
	 
	$queries = DB::table('tpoly_students')
                ->where('INDEXNO','LIKE', '%'.$term.'%')
		->orwhere('SURNAME', 'LIKE', '%'.$term.'%')
		->orWhere('FIRSTNAME', 'LIKE', '%'.$term.'%')
                ->orWhere('OTHERNAMES', 'LIKE', '%'.$term.'%')
                ->orWhere('NAME', 'LIKE', '%'.$term.'%')
                
		->take(500)->get();
	
	foreach ($queries as $query)
	{
	    $results[] = [ 'id' => $query->ID, 'value' => $query->INDEXNO.','.$query->NAME ];
	}
return Response::json($results);
}

 public function searchPatients(){
     
	$term = Input::get('term');
	 
	$results = array();
	
	 
	$queries = \DB::table('tpoly_hrms_patient')
                ->where('hospital_id','LIKE', '%'.$term.'%')
		->orwhere('nhis_id', 'LIKE', '%'.$term.'%')
		->orWhere('surname', 'LIKE', '%'.$term.'%')
                ->orWhere('firstname', 'LIKE', '%'.$term.'%')
                ->orWhere('othername', 'LIKE', '%'.$term.'%')
                
		->take(500)->get();
	
	foreach ($queries as $query)
	{
	    $results[] = [ 'id' => $query->id, 'value' => $query->hospital_id.','.$query->firstname.','.$query->surname ];
	}
return Response::json($results);
}


public function folder(){
	$term = Input::get('term');
	
	$results = array();
	
	 
	$queries = DB::table('tpoly_students')
                ->where('INDEXNO','LIKE', '%'.$term.'%')
		->orwhere('SURNAME', 'LIKE', '%'.$term.'%')
		->orWhere('FIRSTNAME', 'LIKE', '%'.$term.'%')
                ->orWhere('OTHERNAMES', 'LIKE', '%'.$term.'%')
                ->orWhere('NAME', 'LIKE', '%'.$term.'%')
                
		->take(500)->get();
	
	foreach ($queries as $query)
	{
	    $results[] = [ 'id' => $query->ID, 'value' => $query->INDEXNO.','.$query->NAME ];
	}
return Response::json($results);
}
 
}