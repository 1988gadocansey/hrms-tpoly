<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessagesModel; 
use App\Http\Requests;
use App\Http\Controllers\Controller;

 
class SystemController extends Controller
{
     
    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        
    }
    // this is purposely for select box 
    public function getProgramList() {
         $program = \DB::table('tpoly_programme')
                ->lists('PROGRAMME', 'PROGRAMMECODE');
         return $program;
                

    }
     public function getstaffList() {
         $student = \DB::table('tpoly_workers')
                ->lists('NAME', 'id');
         return $student;
    }
    public function getHospitalID() {
         $no = \DB::table('tpoly_hospitalID')->lists('NO');
                
         return $no;
        
    }
    public function getstudentList() {
         $student = \DB::table('tpoly_students')
                ->lists('NAME', 'ID');
         return $student;
        
    }
    public function getHispitalCode() {
         $code = \DB::table('tpoly_hospitalid')
                ->lists('NO');
         
         return $code;
        
    }
     public function age($birthdate, $pattern = 'eu')
        {
            $patterns = array(
                'eu'    => 'd/m/Y',
                'mysql' => 'Y-m-d',
                'us'    => 'm/d/Y',
                'gh'    => 'd-m-Y',
            );

            $now      = new \DateTime();
            $in       = \DateTime::createFromFormat($patterns[$pattern], $birthdate);
            $interval = $now->diff($in);
            return $interval->y;
        }
     public function firesms($message,$phone,$receipient){
          
         
        
        //print_r($contacts);
        if (!empty($phone)&& !empty($message)&& !empty($receipient)) {
            //$sender = "TPOLY-FEES";
                 
                //$key = "83f76e13c92d33e27895";
                $message = urlencode($message);
                $phone="0".$phone; // because most of the numbers came from excel upload
                 
                 $phone="+233".\substr($phone,1,9);
            $url = 'http://txtconnect.co/api/send/'; 
            $fields = array( 
            'token' => \urlencode('a166902c2f552bfd59de3914bd9864088cd7ac77'), 
            'msg' => \urlencode($message), 
            'from' => \urlencode("TPOLY"), 
            'to' => \urlencode($phone), 
            );
            $fields_string = ""; 
                    foreach ($fields as $key => $value) { 
                    $fields_string .= $key . '=' . $value . '&'; 
                    } 
                    \rtrim($fields_string, '&'); 
                    $ch = \curl_init(); 
                    \curl_setopt($ch, \CURLOPT_URL, $url); 
                    \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true); 
                    \curl_setopt($ch, \CURLOPT_FOLLOWLOCATION, true); 
                    \curl_setopt($ch, \CURLOPT_POST, count($fields)); 
                    \curl_setopt($ch, \CURLOPT_POSTFIELDS, $fields_string); 
                    \curl_setopt($ch, \CURLOPT_SSL_VERIFYPEER, 0); 
                    $result2 = \curl_exec($ch); 
                    \curl_close($ch); 
                    $data = \json_decode($result2); 
                    $output=@$data->error;
                    if ($output == "0") {
                   $result="Message was successfully sent"; 
                   
                    }else{ 
                    $result="Message failed to send. Error: " .  $output; 
                     
                    } 
                     
                
                $array=  $this->getSemYear();
                $sem=$array[0]->SEMESTER;
                $year=$array[0]->YEAR;
                  $user = \Auth::user()->id;
                  $sms=new MessagesModel();
                    $sms->dates=\DB::raw("NOW()");
                    $sms->message=$message;
                    $sms->phone=$phone;
                    $sms->status=$result;
                    $sms->type="Fees reminder";
                    $sms->sender=$user;
                    $sms->term=$sem;
                    $sms->year=$year;
                    $sms->receipient=$receipient;
                     
                   $sms->save();
            }
        
    }
    /**
     * Get current sem and year
     *
     * @param  Request  $request
     * @return Response
     */
    public function getSemYear()
    {
        $sql =\DB::table('tpoly_academic_settings')->where('ID', \DB::raw("(select max(`ID`) from tpoly_academic_settings)"))->get();
        return $sql;
    }
    public function getProgram($code){
        
        $programme = \DB::table('tpoly_programme')->where('PROGRAMMECODE',$code)->get();
                 
        return $programme[0]->PROGRAMME;
     
    }
   public function picture($path,$target){
                if(file_exists($path)){
                        $mypic = getimagesize($path);

                 $width=$mypic[0];
                        $height=$mypic[1];

                if ($width > $height) {
                $percentage = ($target / $width);
                } else {
                $percentage = ($target / $height);
                }

                //gets the new value and applies the percentage, then rounds the value
                 $width = round($width * $percentage);
                $height = round($height * $percentage);

               echo "width=\"$width\" height=\"$height\"";



            }else{}
        
       
        }
        
        
	public function pictureid($stuid) {

        return str_replace('/', '', $stuid);
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
